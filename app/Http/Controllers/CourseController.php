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
        $all_courses = Course::all();

        $sectors = Sector::withCount('courses')->get();

        $half_year_from_now = now()->addMonths(5);
        $all_course_ids = $all_courses->pluck('id');
        $start_dates = StartDate::whereIn('course_id', $all_course_ids)->where('date', '>=', now())->where('date', '<=', $half_year_from_now)->get();
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

        $course_types = CourseType::withCount(['courses' => function ($query) use ($all_courses) {
            $query->whereIn('id', $all_courses->pluck('id'));
        }])->get();

        $durations = Duration::withCount(['courses' => function ($query) use ($all_courses) {
            $query->whereIn('id', $all_courses->pluck('id'));
        }])->get();

        $locations = Location::withCount(['startDates' => function ($query) use ($all_courses) {
            $query->whereIn('course_id', $all_courses->pluck('id'));
        }])->get();

        $savings = Saving::withCount(['courses' => function ($query) use ($all_courses) {
            $query->whereIn('course_id', $all_courses->pluck('id'));
        }])->get();

        $special_properties = SpecialProperty::withCount(['courses' => function ($query) use ($all_courses) {
            $query->whereIn('course_id', $all_courses->pluck('id'));
        }])->get();

        $levels = Level::withCount(['courses' => function ($query) use ($all_courses) {
            $query->whereIn('id', $all_courses->pluck('id'));
        }])->get();

        $study_types = StudyType::withCount(['courses' => function ($query) use ($all_courses) {
            $query->whereIn('id', $all_courses->pluck('id'));
        }])->get();

        $courses = Course::with('savings', 'specialProperties', 'priceDetails', 'people', 'kmoTheme', 'sector', 'courseType', 'duration', 'level', 'studyType')->paginate(10);

        return compact(
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
        );
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
