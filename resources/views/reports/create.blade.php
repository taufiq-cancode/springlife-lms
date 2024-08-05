@extends('theme.campus-master')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    <div class="content-wrapper">

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Reports</span></h4>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gy-4 mb-4">
                            @if(auth()->check() && auth()->user()->role === 'student_coordinator')
                                <form method="POST" action="{{ route('report.student') }}" enctype="multipart/form-data">
                                    @csrf
                                
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="chapter_name" class="form-label">Name of your Chapter</label>
                                            <input type="text" id="chapter_name" value="{{ auth()->user()->chapter->name }}" class="form-control" disabled placeholder="Enter your chapter name">
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="zone_or_conference_name" class="form-label">Name of your Zone/Conference</label>
                                            <input type="text" id="zone_or_conference_name" name="zone_or_conference_name" class="form-control" required placeholder="Enter your zone or conference name">
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="year_level" class="form-label">What year/level are you?</label>
                                            <select id="year_level" name="year_level" class="form-control" required>
                                                <option value="" selected disabled>Select Year/Level</option>
                                                <option value="100 level">100 Level</option>
                                                <option value="200 level">200 Level</option>
                                                <option value="300 level">300 Level</option>
                                                <option value="400 level">400 Level</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="phone_number" class="form-label">Your Phone Number</label>
                                            <input type="text" id="phone_number" name="phone_number" class="form-control" required placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="mission_training_completed" class="form-label">Have you completed the online Mission training?</label>
                                            <select id="mission_training_completed" name="mission_training_completed" class="form-control" required>
                                                <option value="" selected disabled>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="row" id="mission_training_completed_date_row" style="display: none;">
                                        <div class="col mb-3">
                                            <label for="mission_training_completed_date" class="form-label">If yes, Date completed</label>
                                            <input type="date" id="mission_training_completed_date" name="mission_training_completed_date" class="form-control">
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="christ_our_saviour_bible_study_completed" class="form-label">Have you completed Christ Our Saviour bible study?</label>
                                            <select id="christ_our_saviour_bible_study_completed" name="bible_study_completed" class="form-control" required>
                                                <option value="" selected disabled>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="row" id="bible_study_completed_date_row" style="display: none;">
                                        <div class="col mb-3">
                                            <label for="bible_study_completed_date" class="form-label">If yes, Date completed</label>
                                            <input type="date" id="bible_study_completed_date" name="bible_study_completed_date" class="form-control">
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col mb-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                
                                <script>
                                    document.getElementById('mission_training_completed').addEventListener('change', function () {
                                        var dateRow = document.getElementById('mission_training_completed_date_row');
                                        if (this.value == '1') {
                                            dateRow.style.display = 'block';
                                        } else {
                                            dateRow.style.display = 'none';
                                            document.getElementById('mission_training_completed_date').value = '';
                                        }
                                    });
                                    
                                    document.getElementById('christ_our_saviour_bible_study_completed').addEventListener('change', function () {
                                        var dateRow = document.getElementById('bible_study_completed_date_row');
                                        if (this.value == '1') {
                                            dateRow.style.display = 'block';
                                        } else {
                                            dateRow.style.display = 'none';
                                            document.getElementById('bible_study_completed_date').value = '';
                                        }
                                    });
                                </script>
                            @endif
                            
                            @if(auth()->check() && auth()->user()->role === 'mission_coordinator')
                                <form method="POST" action="{{ route('report.mission') }}" enctype="multipart/form-data">
                                    @csrf
        
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name_of_your_institution" class="form-label">Name of your Institution</label>
                                            <input type="text" id="name_of_your_institution" name="name_of_your_institution" class="form-control" required placeholder="Enter Institution Name">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="date_of_the_report" class="form-label">Date of the Report</label>
                                            <input type="date" id="date_of_the_report" name="date_of_the_report" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name_of_your_witnessing_partner" class="form-label">Name of your Witnessing Partner</label>
                                            <input type="text" id="name_of_your_witnessing_partner" name="name_of_your_witnessing_partner" class="form-control" placeholder="Enter Witnessing Partner">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_contacts_this_month" class="form-label">Number of Contacts this Month</label>
                                            <input type="number" id="number_of_contacts_this_month" name="number_of_contacts_this_month" class="form-control" placeholder="Enter Number of Contacts">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_bible_studies_given" class="form-label">Number of Bible Studies Given</label>
                                            <input type="number" id="number_of_bible_studies_given" name="number_of_bible_studies_given" class="form-control" placeholder="Enter Number of Bible Studies">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="total_hours_put_into_mission_this_month" class="form-label">Total hours put into mission this month</label>
                                            <input type="number" id="total_hours_put_into_mission_this_month" name="total_hours_put_into_mission_this_month" class="form-control" placeholder="Enter Total Hours">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_literatures_given" class="form-label">Number of literatures given</label>
                                            <input type="number" id="number_of_literatures_given" name="number_of_literatures_given" class="form-control" placeholder="Enter Number of Literatures">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_interest_in_bible_study_given" class="form-label">Number of interest in bible study given</label>
                                            <input type="number" id="number_of_interest_in_bible_study_given" name="number_of_interest_in_bible_study_given" class="form-control" placeholder="Enter Number of Interests">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="any_challenge_encounter_on_mission_field" class="form-label">Any challenge encounter on mission field</label>
                                            <textarea id="any_challenge_encounter_on_mission_field" name="any_challenge_encounter_on_mission_field" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="any_mission_related_testimony_or_story" class="form-label">Any mission related testimony or story that you will like to share</label>
                                            <textarea id="any_mission_related_testimony_or_story" name="any_mission_related_testimony_or_story" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <button type="submit" class="btn btn-primary">Submit Report</button>
                                        </div>
                                    </div>

                                </form>
                            @elseif (auth()->check() && auth()->user()->role === 'chapter_coordinator')
                                <form method="POST" action="{{ route('report.chapter') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name_of_your_institution" class="form-label">Name of your Institution</label>
                                            <input type="text" id="name_of_your_institution" name="name_of_your_institution" class="form-control" required placeholder="Enter Institution Name">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="date_of_the_report" class="form-label">Date of the Report</label>
                                            <input type="date" id="date_of_the_report" name="date_of_the_report" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_students_in_your_chapter" class="form-label">Number of Students in Your Chapter</label>
                                            <input type="number" id="number_of_students_in_your_chapter" name="number_of_students_in_your_chapter" class="form-control" placeholder="Enter Number of Students">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_missionaries_in_your_chapter" class="form-label">Number of Missionaries in Your Chapter</label>
                                            <input type="number" id="number_of_missionaries_in_your_chapter" name="number_of_missionaries_in_your_chapter" class="form-control" placeholder="Enter Number of Missionaries">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_active_missionaries_this_month" class="form-label">Number of active missionaries this month</label>
                                            <input type="text" id="number_of_active_missionaries_this_month" name="number_of_active_missionaries_this_month" class="form-control" placeholder="Enter number of active missionaries this month">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_contacts_this_month" class="form-label">Number of Contacts this Month</label>
                                            <input type="number" id="number_of_contacts_this_month" name="number_of_contacts_this_month" class="form-control" placeholder="Enter Number of Contacts">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_bible_studies_given" class="form-label">Number of Bible Studies Given</label>
                                            <input type="number" id="number_of_bible_studies_given" name="number_of_bible_studies_given" class="form-control" placeholder="Enter Number of Bible Studies">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="total_hours_put_into_mission_this_month" class="form-label">Total hours put into mission this month</label>
                                            <input type="number" id="total_hours_put_into_mission_this_month" name="total_hours_put_into_mission_this_month" class="form-control" placeholder="Enter Total Hours">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_literatures_given" class="form-label">Number of literatures given</label>
                                            <input type="number" id="number_of_literatures_given" name="number_of_literatures_given" class="form-control" placeholder="Enter Number of Literatures">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name_of_the_missionary_of_the_month" class="form-label">Name of the missionary of the month</label>
                                            <input type="text" id="name_of_the_missionary_of_the_month" name="name_of_the_missionary_of_the_month" class="form-control" placeholder="Enter Name of Missionary">
                                        </div>
                                    </div>
                                    
                                    <h5 class="py-3 mb-4"><span class="fw-light">Corporate Mission Activities</span></h5>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="did_your_chapter_embark_on_mission_related_program_this_month" class="form-label">Did your chapter embark on mission related program this month?</label>
                                            <select id="did_your_chapter_embark_on_mission_related_program_this_month" name="did_your_chapter_embark_on_mission_related_program_this_month" class="form-select">
                                                <option>Select option</option>
                                                <option id="yes" value="Yes">Yes</option>
                                                <option id="no" value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="if_yes_give_detail_in_this_box_below" class="form-label">If yes to the above question. Give detail in this box below</label>
                                            <textarea id="if_yes_give_detail_in_this_box_below" name="if_yes_give_detail_in_this_box_below" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label>Does any chapter have any Mission related program coming up soon?</label><br>
                                            <input type="radio" id="mission_program_yes" name="mission_program" value="yes" onclick="toggleProgramDetails(true)">
                                            <label for="mission_program_yes">Yes</label><br>
                                            <input type="radio" id="mission_program_no" name="mission_program" value="no" onclick="toggleProgramDetails(false)">
                                            <label for="mission_program_no">No</label><br><br>
                                        </div>
                                    </div>
                                
                                    <div id="program_details" style="display: none;">
                                        <h5><span class="fw-light">If yes, please list below:</span></h5>
                                        
                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date1" class="form-label">1 Date:</label>
                                                    <input type="date" id="date1" name="date1" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program1" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program1" name="program1" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date2" class="form-label">2 Date:</label>
                                                    <input type="date" id="date2" name="date2" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program2" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program2" name="program2" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date3" class="form-label">3 Date:</label>
                                                    <input type="date" id="date3" name="date3" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program3" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program3" name="program3" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="is_your_chapter_facing_any_challenge_in_the_mission_field" class="form-label">Is your chapter facing any challenge in the mission field? Please explain in the below box:</label><br>
                                            <textarea id="is_your_chapter_facing_any_challenge_in_the_mission_field" name="is_your_chapter_facing_any_challenge_in_the_mission_field" class="form-control" rows="5" cols="60"></textarea><br><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <button type="submit" class="btn btn-primary">Submit Report</button>
                                        </div>
                                    </div>
                                </form>
                            @elseif (auth()->check() && auth()->user()->role === 'zonal_coordinator')
                                <form method="POST" action="{{ route('report.zonal') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name_of_your_zone" class="form-label">Name of your Zone</label>
                                            <input type="text" id="name_of_your_zone" value="{{ auth()->user()->zone->name }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="date_of_the_report" class="form-label">Date of the Report</label>
                                            <input type="date" id="date_of_the_report" name="date_of_the_report" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_chapters_in_your_zone" class="form-label">Number of Chapters in Your Zone</label>
                                            <input type="number" id="number_of_chapters_in_your_zone" name="number_of_chapters_in_your_zone" class="form-control" placeholder="Enter Number of Chapters">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_missional_chapters_in_your_zone" class="form-label">Number of Missional chapters in Your zone</label>
                                            <input type="number" id="number_of_missional_chapters_in_your_zone" name="number_of_missional_chapters_in_your_zone" class="form-control" placeholder="Enter Number of Missional Chapters">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_active_missional_chapters_this_month" class="form-label">Number of active missional chapters this month</label>
                                            <input type="number" id="number_of_active_missional_chapters_this_month" name="number_of_active_missional_chapters_this_month" class="form-control" placeholder="Enter Number of Active Missional Chapters">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_contacts_made_this_month" class="form-label">Number of contacts made this month</label>
                                            <input type="number" id="number_of_contacts_made_this_month" name="number_of_contacts_made_this_month" class="form-control" placeholder="Enter Number of Contacts Made this Month">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_bible_studies_given" class="form-label">Number of Bible studies given</label>
                                            <input type="number" id="number_of_bible_studies_given" name="number_of_bible_studies_given" class="form-control" placeholder="Enter Number of Bible Studies Given">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="total_hours_put_into_mission_this_month" class="form-label">Total hours put into Mission this month</label>
                                            <input type="number" id="total_hours_put_into_mission_this_month" name="total_hours_put_into_mission_this_month" class="form-control" placeholder="Enter Total Hours Put in Mission this month">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_literatures_given" class="form-label">Number of literatures given</label>
                                            <input type="number" id="number_of_literatures_given" name="number_of_literatures_given" class="form-control" placeholder="Enter Number of Literatures Given">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name_of_the_missionary_of_the_month" class="form-label">Name of the missionary of the month</label>
                                            <input type="text" id="name_of_the_missionary_of_the_month" name="name_of_the_missionary_of_the_month" class="form-control" placeholder="Enter Name of Missionary">
                                        </div>
                                    </div>
                                    
                                    <h5 class="py-3 mb-4"><span class="text-muted fw-light">Corporate Mission Activities</span></h5>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="did_any_chapter_embark_on_mission_related_program_this_month" class="form-label">Did any chapter embark on mission related program this month?</label>
                                            <select id="did_any_chapter_embark_on_mission_related_program_this_month" name="did_any_chapter_embark_on_mission_related_program_this_month" class="form-select">
                                                <option>Select option</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="if_yes_give_detail_in_this_box_below" class="form-label">If yes to the above question. Give detail in this box below</label>
                                            <textarea id="if_yes_give_detail_in_this_box_below" name="if_yes_give_detail_in_this_box_below" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="any_photograph_taken_during_the_mission_event" class="form-label">Any photograph taken during the mission event? Please upload</label>
                                            <input type="file" multiple id="any_photograph_taken_during_the_mission_event" name="any_photograph_taken_during_the_mission_event[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="mission_follow_up_plan" class="form-label">Mission follow up plan: What follow up plans were put in place? Please give the detail in the box below</label>
                                            <textarea id="mission_follow_up_plan" name="mission_follow_up_plan" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label>Does any chapter have any Mission related program coming up soon?</label><br>
                                            <input type="radio" id="mission_program_yes" name="mission_program" value="yes" onclick="toggleProgramDetails(true)">
                                            <label for="mission_program_yes">Yes</label><br>
                                            <input type="radio" id="mission_program_no" name="mission_program" value="no" onclick="toggleProgramDetails(false)">
                                            <label for="mission_program_no">No</label><br><br>
                                        </div>
                                    </div>
                                
                                    <div id="program_details" style="display: none;">
                                        <h5><span class="fw-light">If yes, please list below:</span></h5>
                                        
                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date1" class="form-label">1 Date:</label>
                                                    <input type="date" id="date1" name="date1" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program1" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program1" name="program1" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date2" class="form-label">2 Date:</label>
                                                    <input type="date" id="date2" name="date2" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program2" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program2" name="program2" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date3" class="form-label">3 Date:</label>
                                                    <input type="date" id="date3" name="date3" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program3" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program3" name="program3" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="is_any_chapter_facing_any_challenge_in_the_mission_field" class="form-label">Is any Chapter facing any challenge in the mission field? Please explain in the below box:</label><br>
                                            <textarea id="is_any_chapter_facing_any_challenge_in_the_mission_field" name="is_any_chapter_facing_any_challenge_in_the_mission_field" rows="5" cols="60" class="form-control"></textarea><br><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <button type="submit" class="btn btn-primary">Submit Report</button>
                                        </div>
                                    </div>
                                </form>
                            @elseif (auth()->check() && auth()->user()->role === 'regional_coordinator')
                                <form method="POST" action="{{ route('report.regional') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name_of_your_region" class="form-label">Name of your Region</label>
                                            <select id="name_of_your_region" name="name_of_your_region" class="form-select">
                                                <option>Select Region</option>
                                                <option value="Western Region">Western Region</option>
                                                <option value="Eastern Region">Eastern Region</option>
                                                <option value="Northern Region">Northern Region</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="date_of_the_report" class="form-label">Date of the Report</label>
                                            <input type="date" id="date_of_the_report" name="date_of_the_report" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_zones_in_your_region" class="form-label">Number of Zones in your Region</label>
                                            <input type="number" id="number_of_zones_in_your_region" name="number_of_zones_in_your_region" class="form-control" placeholder="Enter Number of Zones">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_missional_zones_in_your_region" class="form-label">Number of Missional zones in Your Region</label>
                                            <input type="number" id="number_of_missional_zones_in_your_region" name="number_of_missional_zones_in_your_region" class="form-control" placeholder="Enter Number of Missional Zones">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_active_missional_zones_this_month" class="form-label">Number of active missional zones this month</label>
                                            <input type="number" id="number_of_active_missional_zones_this_month" name="number_of_active_missional_zones_this_month" class="form-control" placeholder="Enter Number of Active Missional Zones">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_contacts_made_this_month" class="form-label">Number of contacts made this month</label>
                                            <input type="number" id="number_of_contacts_made_this_month" name="number_of_contacts_made_this_month" class="form-control" placeholder="Enter Number of Contacts Made">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_bible_studies_given" class="form-label">Number of Bible studies given</label>
                                            <input type="number" id="number_of_bible_studies_given" name="number_of_bible_studies_given" class="form-control" placeholder="Enter Number of Bible Studies given">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="total_hours_put_into_mission_this_month" class="form-label">Total hours put into Mission this month</label>
                                            <input type="number" id="total_hours_put_into_mission_this_month" name="total_hours_put_into_mission_this_month" class="form-control" placeholder="Enter total hours put into mission this month">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="number_of_literatures_given" class="form-label">Number of literatures given</label>
                                            <input type="number" id="number_of_literatures_given" name="number_of_literatures_given" class="form-control" placeholder="Enter Number of literatures given">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name_of_the_missionary_of_the_month" class="form-label">Name of the missionary of the month</label>
                                            <input type="text" id="name_of_the_missionary_of_the_month" name="name_of_the_missionary_of_the_month" class="form-control" placeholder="Enter Name of Missionary">
                                        </div>
                                    </div>
                                    
                                    <h5 class="py-3 mb-4"><span class="text-muted fw-light">Corporate Mission Activities</span></h5>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="did_any_zone_embark_on_mission_related_program_this_month" class="form-label">Did any zone embark on mission related program this month?</label>
                                            <select id="did_any_zone_embark_on_mission_related_program_this_month" name="did_any_zone_embark_on_mission_related_program_this_month" class="form-select">
                                                <option>Select option</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="if_yes_give_detail_in_this_box_below" class="form-label">If yes to the above question. Give detail in this box below</label>
                                            <textarea id="if_yes_give_detail_in_this_box_below" name="if_yes_give_detail_in_this_box_below" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="any_photograph_taken_during_the_mission_event" class="form-label">Any photograph taken during the mission event? Please upload</label>
                                            <input type="file" multiple id="any_photograph_taken_during_the_mission_event" name="any_photograph_taken_during_the_mission_event[]" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="mission_follow_up_plan" class="form-label">Mission follow up plan: What follow up plans were put in place? Please give the detail in the box below</label>
                                            <textarea id="mission_follow_up_plan" name="mission_follow_up_plan" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label>Does any chapter have any Mission related program coming up soon?</label><br>
                                            <input type="radio" id="mission_program_yes" name="mission_program" value="yes" onclick="toggleProgramDetails(true)">
                                            <label for="mission_program_yes">Yes</label><br>
                                            <input type="radio" id="mission_program_no" name="mission_program" value="no" onclick="toggleProgramDetails(false)">
                                            <label for="mission_program_no">No</label><br><br>
                                        </div>
                                    </div>
                                
                                    <div id="program_details" style="display: none;">
                                        <h5><span class="fw-light">If yes, please list below:</span></h5>
                                        
                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date1" class="form-label">1 Date:</label>
                                                    <input type="date" id="date1" name="date1" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program1" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program1" name="program1" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date2" class="form-label">2 Date:</label>
                                                    <input type="date" id="date2" name="date2" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program2" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program2" name="program2" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div style="margin-bottom: -30px">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="date3" class="form-label">3 Date:</label>
                                                    <input type="date" id="date3" name="date3" class="form-control"><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="program3" class="form-label">Name of the program:</label>
                                                    <input type="text" id="program3" name="program3" size="50" class="form-control"><br><br>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="is_any_chapter_facing_any_challenge_in_the_mission_field" class="form-label">Is any Chapter facing any challenge in the mission field? Please explain in the below box:</label><br>
                                            <textarea id="is_any_chapter_facing_any_challenge_in_the_mission_field" class="form-control" name="is_any_chapter_facing_any_challenge_in_the_mission_field" rows="5" cols="60"></textarea><br><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <button type="submit" class="btn btn-primary">Submit Report</button>
                                        </div>
                                    </div>

                                </form>
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