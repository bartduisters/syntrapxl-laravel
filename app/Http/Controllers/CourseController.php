<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Level;
use App\Models\Course;
use App\Models\Saving;
use App\Models\Sector;
use App\Models\Duration;
use App\Models\Location;
use App\Models\StartDate;
use App\Models\CourseType;
use Illuminate\Http\Request;
use App\Models\SpecialProperty;
use App\Models\StudyType;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filtered_courses = Course::all();

        if (request()->has('sectors')) {
            $filter_sector_ids = request()->input('sectors');
            $filtered_courses = $filtered_courses->whereIn('sector_id', $filter_sector_ids);
        }

        if (request()->has('start_dates')) {
            $filter_start_date_timestamps = request()->input('start_dates');
            $filter_dates = array_map(function ($timestamp) {
                return [
                    'first_day_of_month' => Carbon::createFromTimestamp($timestamp)->startOfMonth(),
                    'last_day_of_month' => Carbon::createFromTimestamp($timestamp)->endOfMonth()
                ];
            }, $filter_start_date_timestamps);

            $filtered_course_ids = $filtered_courses->pluck('id');
            $start_dates_within_range = StartDate::whereIn('course_id', $filtered_course_ids)
                ->where(function ($query) use ($filter_dates) {
                    foreach ($filter_dates as $date) {
                        $query->orWhereBetween('date', [$date['first_day_of_month'], $date['last_day_of_month']]);
                    }
                })->get();

            $filtered_course_ids = $start_dates_within_range->pluck('course_id');
            $filtered_courses = $filtered_courses->whereIn('id', $filtered_course_ids);
        }

        if (request()->has('course_types')) {
            $filter_course_type_ids = request()->input('course_types');
            $filtered_courses = $filtered_courses->whereIn('course_type_id', $filter_course_type_ids);
        }

        if (request()->has('durations')) {
            $filter_duration_ids = request()->input('durations');
            $filtered_courses = $filtered_courses->whereIn('duration_id', $filter_duration_ids);
        }

        if (request()->has('locations')) {
            $filter_location_ids = request()->input('locations');
            $filtered_course_ids = $filtered_courses->pluck('id');
            $filtered_locations = StartDate::whereIn('course_id', $filtered_course_ids)->whereIn('location_id', $filter_location_ids)->get();
            $filtered_course_ids = $filtered_locations->pluck('course_id');
            $filtered_courses = $filtered_courses->whereIn('id', $filtered_course_ids);
        }

        if (request()->has('savings')) {
            $filter_saving_ids = request()->input('savings');
            $filtered_courses = $filtered_courses->filter(function ($course) use ($filter_saving_ids) {
                $course_saving_ids = $course->load('savings')->savings->pluck('id')->toArray();
                return count(array_intersect($course_saving_ids, $filter_saving_ids)) > 0;
            });
        }

        if (request()->has('special_properties')) {
            $filter_special_property_ids = request()->input('special_properties');
            $filtered_courses = $filtered_courses->filter(function ($course) use ($filter_special_property_ids) {
                $course_special_property_ids = $course->load('specialProperties')->specialProperties->pluck('id')->toArray();
                return count(array_intersect($course_special_property_ids, $filter_special_property_ids)) > 0;
            });
        }

        if (request()->has('levels')) {
            $filter_level_ids = request()->input('levels');
            $filtered_courses = $filtered_courses->whereIn('level_id', $filter_level_ids);
        }

        if (request()->has('study_types')) {
            $filter_study_type_ids = request()->input('study_types');
            $filtered_courses = $filtered_courses->whereIn('study_type_id', $filter_study_type_ids);
        }

        $sectors = Sector::withCount('courses')->get();

        $half_year_from_now = now()->addMonths(5);
        $filtered_course_ids = $filtered_courses->pluck('id');
        $start_dates = StartDate::whereIn('course_id', $filtered_course_ids)->where('date', '>=', now())->where('date', '<=', $half_year_from_now)->get();
        $sorted_start_dates = $start_dates->sortBy('date');
        $dates_grouped_by_months = $sorted_start_dates->groupBy(function ($date) {
            $date = Carbon::parse($date->date);
            return  $date->translatedFormat('F Y');
        });
        $start_dates = [];
        $dates_grouped_by_months->each(function ($dates) use (&$start_dates) {
            $first_day_timestamp = Carbon::parse($dates->first()->date)->startOfMonth()->timestamp;
            $date_data = [
                'name' => Carbon::parse($dates->first()->date)->translatedFormat('F Y'),
                'timestamp' => $first_day_timestamp,
                'count' => $dates->count()
            ];
            array_push($start_dates, $date_data);
        });

        $course_types = CourseType::withCount(['courses' => function ($query) use ($filtered_courses) {
            $query->whereIn('id', $filtered_courses->pluck('id'));
        }])->get();

        $durations = Duration::withCount(['courses' => function ($query) use ($filtered_courses) {
            $query->whereIn('id', $filtered_courses->pluck('id'));
        }])->get();

        $locations = Location::withCount(['startDates' => function ($query) use ($filtered_courses) {
            $query->whereIn('course_id', $filtered_courses->pluck('id'));
        }])->get();

        $savings = Saving::withCount(['courses' => function ($query) use ($filtered_courses) {
            $query->whereIn('course_id', $filtered_courses->pluck('id'));
        }])->get();

        $special_properties = SpecialProperty::withCount(['courses' => function ($query) use ($filtered_courses) {
            $query->whereIn('course_id', $filtered_courses->pluck('id'));
        }])->get();

        $levels = Level::withCount(['courses' => function ($query) use ($filtered_courses) {
            $query->whereIn('id', $filtered_courses->pluck('id'));
        }])->get();

        $study_types = StudyType::withCount(['courses' => function ($query) use ($filtered_courses) {
            $query->whereIn('id', $filtered_courses->pluck('id'));
        }])->get();

        $filtered_course_ids = $filtered_courses->pluck('id');
        $courses = Course::whereIn('id', $filtered_course_ids)
            ->with('savings', 'specialProperties', 'priceDetails', 'people', 'kmoTheme', 'sector', 'courseType', 'duration', 'level', 'studyType', 'startDates', 'startDates.location')
            ->paginate(10)
            ->withQueryString();

        return view('courses.index', compact(
            'courses',
            'sectors',
            'start_dates',
            'course_types',
            'durations',
            'locations',
            'savings',
            'special_properties',
            'levels',
            'study_types',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
