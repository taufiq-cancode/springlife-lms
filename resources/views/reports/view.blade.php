@extends('theme.campus-master')
@section('content')

    <div class="content-wrapper">

    <div class="container-xxl flex-grow-1 container-p-y">    
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gy-4 mb-4">
                            @if ($role === 'student_coordinator')
                                <div class="container">
                                    <h2>Student Report</h2>
                                        <div class="card-body">
                                            <p><strong>Student Name:</strong> {{ $report->full_name }}</p>
                                            <p><strong>Email Address:</strong> {{ $report->email }}</p>
                                            <p><strong>Chapter Name:</strong> {{ $report->chapter_name }}</p>
                                            <p><strong>Zone/Conference Name:</strong> {{ $report->zone_or_conference_name }}</p>
                                            <p><strong>Year/Level:</strong> {{ $report->year_level }}</p>
                                            <p><strong>Phone Number:</strong> {{ $report->phone_number }}</p>
                                            <p><strong>Mission Training Completed:</strong> {{ $report->mission_training_completed ? 'Yes' : 'No' }}</p>
                                            @if($report->mission_training_completed)
                                                <p><strong>Date Completed:</strong> {{ $report->mission_training_completed_date }}</p>
                                            @endif
                                            <p><strong>Bible Study Completed:</strong> {{ $report->bible_study_completed ? 'Yes' : 'No' }}</p>
                                            @if($report->bible_study_completed)
                                                <p><strong>Date Completed:</strong> {{ $report->bible_study_completed_date }}</p>
                                            @endif
                                        </div>
                                </div>
                            @elseif ($role === 'chapter_coordinator')
                                <div class="container">
                                    <h2>Chapter Report</h2>

                                    <div class="card-body">
                                        <p><strong>Name of Institution:</strong> {{ $report->name_of_your_institution }}</p>
                                        <p><strong>Date of the Report:</strong> {{ $report->date_of_the_report }}</p>
                                        <p><strong>Number of student in chapter:</strong> {{ $report->number_of_students_in_your_chapter }}</p>
                                        <p><strong>Number of missionaries in chapter:</strong> {{ $report->number_of_missionaries_in_your_chapter }}</p>
                                        <p><strong>Number of active missionaries:</strong> {{ $report->number_of_active_missionaries_this_month }}</p>
                                        <p><strong>Number of contacts this month:</strong> {{ $report->number_of_contacts_this_month }}</p>
                                        <p><strong>Number of bible studies given:</strong> {{ $report->number_of_bible_studies_given }}</p>
                                        <p><strong>Total hours put into mission this montht:</strong> {{ $report->total_hours_put_into_mission_this_month }}</p>
                                        <p><strong>Number of literatures given:</strong> {{ $report->number_of_literatures_given }}</p>
                                        <p><strong>Name of missionary of the month:</strong> {{ $report->name_of_the_missionary_of_the_month }}</p>
                                        <p><strong>Did chapter embark on mission related program this month:</strong> {{ $report->did_your_chapter_embark_on_mission_related_program_this_month }}</p>
                                        
                                        @if ($report->did_your_chapter_embark_on_mission_related_program_this_month === 'Yes')
                                            <p><strong>Mission related program this:</strong> {{ $report->if_yes_give_detail_in_this_box_below }}</p>
                                        @endif
                                        
                                        @if ($report->mission_program === 'yes')
                                            <p><strong>Date 1:</strong> {{ $report->date1 }}</p>
                                            <p><strong>Program 1:</strong> {{ $report->program1 }}</p>
                                            
                                            @if($report->program2)
                                                <p><strong>Date 2:</strong> {{ $report->date2 }}</p>
                                                <p><strong>Program 2:</strong> {{ $report->program2 }}</p>
                                            @endif

                                            @if($report->program3)
                                                <p><strong>Date 3:</strong> {{ $report->date3 }}</p>
                                                <p><strong>Program 3:</strong> {{ $report->program3 }}</p>
                                            @endif
                                        @endif

                                        <p><strong>Challenges faced:</strong> {{ $report->is_your_chapter_facing_any_challenge_in_the_mission_field }}</p>
                                 
                                </div>
                            @elseif ($role === 'zonal_coordinator')
                                <div class="container">
                                    <h2>Zonal Report</h2>
                                
                                    <div class="card-body">
                                        <p><strong>Name of Your Zone:</strong> {{ $report->name_of_your_zone }}</p>
                                        <p><strong>Date of the Report:</strong> {{ $report->date_of_the_report }}</p>
                                        <p><strong>Number of Chapters in Your Zone:</strong> {{ $report->number_of_chapters_in_your_zone }}</p>
                                        <p><strong>Number of Missional Chapters in Your Zone:</strong> {{ $report->number_of_missional_chapters_in_your_zone }}</p>
                                        <p><strong>Number of Active Missional Chapters this Month:</strong> {{ $report->number_of_active_missional_chapters_this_month }}</p>
                                        <p><strong>Number of Contacts Made this Month:</strong> {{ $report->number_of_contacts_made_this_month }}</p>
                                        <p><strong>Number of Bible Studies Given:</strong> {{ $report->number_of_bible_studies_given }}</p>
                                        <p><strong>Total Hours Put into Mission this Month:</strong> {{ $report->total_hours_put_into_mission_this_month }}</p>
                                        <p><strong>Number of Literatures Given:</strong> {{ $report->number_of_literatures_given }}</p>
                                        <p><strong>Name of the Missionary of the Month:</strong> {{ $report->name_of_the_missionary_of_the_month }}</p>
                                        <p><strong>Did Any Chapter Embark on Mission Related Program this Month:</strong> {{ $report->did_any_chapter_embark_on_mission_related_program_this_month }}</p>
                                        
                                        @if ($report->did_any_chapter_embark_on_mission_related_program_this_month === 'Yes')
                                            <p><strong>Mission Related Program Details:</strong> {{ $report->if_yes_give_detail_in_this_box_below }}</p>
                                        @endif
                                        
                                        <p><strong>Uploaded Images</strong></p>
                                        @if ($report->any_photograph_taken_during_the_mission_event)
                                            @php
                                                $imagePaths = json_decode($report->any_photograph_taken_during_the_mission_event);
                                            @endphp
                                            @if ($imagePaths)
                                                <div class="row">
                                                    @foreach ($imagePaths as $imagePath)
                                                        <div class="col-md-4">
                                                            <a href="{{ asset('storage/' . $imagePath) }}" data-lightbox="mission-images" data-title="Mission Image">
                                                                <img src="{{ asset('storage/' . $imagePath) }}" class="img-fluid" alt="Mission Image">
                                                            </a>
                                                            <a href="{{ asset('storage/' . $imagePath) }}" download >Download</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p>No images uploaded.</p>
                                            @endif
                                        @else
                                            <p>No images uploaded.</p>
                                        @endif
                                        <br>
                                        <p><strong>Mission Follow-up Plan:</strong> {{ $report->mission_follow_up_plan }}</p>
                                
                                        @if ($report->mission_program === 'yes')
                                            <p><strong>Date 1:</strong> {{ $report->date1 }}</p>
                                            <p><strong>Program 1:</strong> {{ $report->program1 }}</p>
                                            
                                            @if($report->program2)
                                                <p><strong>Date 2:</strong> {{ $report->date2 }}</p>
                                                <p><strong>Program 2:</strong> {{ $report->program2 }}</p>
                                            @endif
                                
                                            @if($report->program3)
                                                <p><strong>Date 3:</strong> {{ $report->date3 }}</p>
                                                <p><strong>Program 3:</strong> {{ $report->program3 }}</p>
                                            @endif
                                        @endif
                                
                                        <p><strong>Challenges Faced:</strong> {{ $report->is_any_chapter_facing_any_challenge_in_the_mission_field }}</p>
                                    </div>
                                </div>
                            @elseif ($role === 'regional_coordinator')
                            <div class="container">
                                <h2>Regional Report</h2>
                            
                                <div class="card-body">
                                    <p><strong>Name of Your Region:</strong> {{ $report->name_of_your_region }}</p>
                                    <p><strong>Date of the Report:</strong> {{ $report->date_of_the_report }}</p>
                                    <p><strong>Number of Chapters in Your Zone:</strong> {{ $report->number_of_zones_in_your_region }}</p>
                                    <p><strong>Number of Missional Chapters in Your Zone:</strong> {{ $report->number_of_missional_zones_in_your_region }}</p>
                                    <p><strong>Number of Active Missional Chapters this Month:</strong> {{ $report->number_of_active_missional_zones_this_month }}</p>
                                    <p><strong>Number of Contacts Made this Month:</strong> {{ $report->number_of_contacts_made_this_month }}</p>
                                    <p><strong>Number of Bible Studies Given:</strong> {{ $report->number_of_bible_studies_given }}</p>
                                    <p><strong>Total Hours Put into Mission this Month:</strong> {{ $report->total_hours_put_into_mission_this_month }}</p>
                                    <p><strong>Number of Literatures Given:</strong> {{ $report->number_of_literatures_given }}</p>
                                    <p><strong>Name of the Missionary of the Month:</strong> {{ $report->name_of_the_missionary_of_the_month }}</p>
                                    <p><strong>Did Any Chapter Embark on Mission Related Program this Month:</strong> {{ $report->did_any_chapter_embark_on_mission_related_program_this_month }}</p>
                                    
                                    @if ($report->did_any_chapter_embark_on_mission_related_program_this_month === 'Yes')
                                        <p><strong>Mission Related Program Details:</strong> {{ $report->if_yes_give_detail_in_this_box_below }}</p>
                                    @endif
                                    
                                    <p><strong>Uploaded Images</strong></p>
                                    @if ($report->any_photograph_taken_during_the_mission_event)
                                        @php
                                            $imagePaths = json_decode($report->any_photograph_taken_during_the_mission_event);
                                        @endphp
                                        @if ($imagePaths)
                                            <div class="row">
                                                @foreach ($imagePaths as $imagePath)
                                                    <div class="col-md-4">
                                                        <a href="{{ asset('storage/' . $imagePath) }}" data-lightbox="mission-images" data-title="Mission Image">
                                                            <img src="{{ asset('storage/' . $imagePath) }}" class="img-fluid" alt="Mission Image">
                                                        </a>
                                                        <a href="{{ asset('storage/' . $imagePath) }}" download >Download</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>No images uploaded.</p>
                                        @endif
                                    @else
                                        <p>No images uploaded.</p>
                                    @endif
                                    <br>
                                    <p><strong>Mission Follow-up Plan:</strong> {{ $report->mission_follow_up_plan }}</p>
                            
                                    @if ($report->mission_program === 'yes')
                                        <p><strong>Date 1:</strong> {{ $report->date1 }}</p>
                                        <p><strong>Program 1:</strong> {{ $report->program1 }}</p>
                                        
                                        @if($report->program2)
                                            <p><strong>Date 2:</strong> {{ $report->date2 }}</p>
                                            <p><strong>Program 2:</strong> {{ $report->program2 }}</p>
                                        @endif
                            
                                        @if($report->program3)
                                            <p><strong>Date 3:</strong> {{ $report->date3 }}</p>
                                            <p><strong>Program 3:</strong> {{ $report->program3 }}</p>
                                        @endif
                                    @endif
                            
                                    <p><strong>Challenges Faced:</strong> {{ $report->is_any_chapter_facing_any_challenge_in_the_mission_field }}</p>
                                </div>
                            </div>
                            @elseif ($role === 'national_coordinator')
                            <div class="container">
                                <h2>Zonal Report</h2>
                            
                                <div class="card-body">
                                    <p><strong>Name of Your Zone:</strong> {{ $report->name_of_your_zone }}</p>
                                    <p><strong>Date of the Report:</strong> {{ $report->date_of_the_report }}</p>
                                    <p><strong>Number of Chapters in Your Zone:</strong> {{ $report->number_of_chapters_in_your_zone }}</p>
                                    <p><strong>Number of Missional Chapters in Your Zone:</strong> {{ $report->number_of_missional_chapters_in_your_zone }}</p>
                                    <p><strong>Number of Active Missional Chapters this Month:</strong> {{ $report->number_of_active_missional_chapters_this_month }}</p>
                                    <p><strong>Number of Contacts Made this Month:</strong> {{ $report->number_of_contacts_made_this_month }}</p>
                                    <p><strong>Number of Bible Studies Given:</strong> {{ $report->number_of_bible_studies_given }}</p>
                                    <p><strong>Total Hours Put into Mission this Month:</strong> {{ $report->total_hours_put_into_mission_this_month }}</p>
                                    <p><strong>Number of Literatures Given:</strong> {{ $report->number_of_literatures_given }}</p>
                                    <p><strong>Name of the Missionary of the Month:</strong> {{ $report->name_of_the_missionary_of_the_month }}</p>
                                    <p><strong>Did Any Chapter Embark on Mission Related Program this Month:</strong> {{ $report->did_any_chapter_embark_on_mission_related_program_this_month }}</p>
                                    
                                    @if ($report->did_any_chapter_embark_on_mission_related_program_this_month === 'Yes')
                                        <p><strong>Mission Related Program Details:</strong> {{ $report->if_yes_give_detail_in_this_box_below }}</p>
                                    @endif
                                    
                                    <p><strong>Uploaded Images</strong></p>
                                    @if ($report->any_photograph_taken_during_the_mission_event)
                                        @php
                                            $imagePaths = json_decode($report->any_photograph_taken_during_the_mission_event);
                                        @endphp
                                        @if ($imagePaths)
                                            <div class="row">
                                                @foreach ($imagePaths as $imagePath)
                                                    <div class="col-md-4">
                                                        <a href="{{ asset('storage/' . $imagePath) }}" data-lightbox="mission-images" data-title="Mission Image">
                                                            <img src="{{ asset('storage/' . $imagePath) }}" class="img-fluid" alt="Mission Image">
                                                        </a>
                                                        <a href="{{ asset('storage/' . $imagePath) }}" download >Download</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>No images uploaded.</p>
                                        @endif
                                    @else
                                        <p>No images uploaded.</p>
                                    @endif
                                    <br>
                                    <p><strong>Mission Follow-up Plan:</strong> {{ $report->mission_follow_up_plan }}</p>
                            
                                    @if ($report->mission_program === 'yes')
                                        <p><strong>Date 1:</strong> {{ $report->date1 }}</p>
                                        <p><strong>Program 1:</strong> {{ $report->program1 }}</p>
                                        
                                        @if($report->program2)
                                            <p><strong>Date 2:</strong> {{ $report->date2 }}</p>
                                            <p><strong>Program 2:</strong> {{ $report->program2 }}</p>
                                        @endif
                            
                                        @if($report->program3)
                                            <p><strong>Date 3:</strong> {{ $report->date3 }}</p>
                                            <p><strong>Program 3:</strong> {{ $report->program3 }}</p>
                                        @endif
                                    @endif
                            
                                    <p><strong>Challenges Faced:</strong> {{ $report->is_any_chapter_facing_any_challenge_in_the_mission_field }}</p>
                                </div>
                            </div>                            
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
            document.write(new Date().getFullYear());
            </script> Spring Life Ministry. Developed by
            <a href="https://purplebeetech.com" target="_blank" class="footer-link fw-bolder">Purple Bee Technologies.</a>
        </div>
        </div>
    </footer>

    <script>
        function toggleProgramDetails(isVisible) {
            var programDetails = document.getElementById('program_details');
            if (isVisible) {
                programDetails.style.display = 'block';
            } else {
                programDetails.style.display = 'none';
            }
        }
    </script>
          
@endsection