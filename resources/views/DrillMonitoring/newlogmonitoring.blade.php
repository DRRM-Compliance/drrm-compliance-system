           <form action="{{ route('drill-monitoring.store') }}" method="POST">
    @csrf

<div class="modal fade" id="logMonitoringModal" tabindex="-1">
                <div class="modal-dialog modal-lg"> <!-- Changed to modal-lg for better wide-row formatting -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Log New Drill Monitoring</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="logMonitoringForm" action="{{ route('drill-monitoring.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="unified_school_id" value="{{ $activeSchool->id }}">


                                
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Drill Type *</label>
                                        <select class="form-select border-primary" name="drill_type" required>
                                            <option value="">Select Type</option>
                                            <option value="Earthquake">Earthquake</option>
                                            <option value="Fire">Fire</option>
                                            <option value="Tsunami">Tsunami</option>
                                            <option value="Lockdown">Lockdown</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Date *</label>
                                        <input type="date" class="form-control border-primary" name="inspection_date" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Time *</label>
                                        <input type="time" class="form-control border-primary" name="inspection_time" value="{{ date('H:i') }}" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Time Started</label>
                                        <input type="time" class="form-control" name="time_started">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Time Finished</label>
                                        <input type="time" class="form-control" name="time_finished">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Elapsed Time (mm:ss)</label>
                                        <input type="text" class="form-control" name="elapsed_time" placeholder="e.g. 05:30">
                                    </div>
                                </div>

                                <!-- New Row: Number of Students and Personnel -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Number of Students</label>
                                        <input type="number" class="form-control" name="no_of_students" min="0" value="0" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Number of Personnel</label>
                                        <input type="number" class="form-control" name="no_of_personnel" min="0" value="0">
                                    </div>
                                </div>

                                <!-- New Row: Monitored By and Coordinator -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Monitored By</label>
                                        <input type="text" class="form-control" name="monitored_by" placeholder="Name of monitor/inspector">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Coordinator</label>
                                        <input type="text" class="form-control" name="coordinator_name" placeholder="Name of drill coordinator">
                                    </div>
                                </div>
                                <!-- Row: Findings and Remarks Consolidated -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Findings and Remarks</label>
                                        <textarea class="form-control" name="findings_remarks" rows="4" placeholder="Enter issues observed, equipment conditions, recommendations, or corrective actions here..."></textarea>
                                    </div>
                                </div>

<!-- Checklists -->
<div class="mb-4">
    <label class="form-label fw-bold mb-2">Drill Evaluation Checklist</label>
    <div class="row g-3">
        
        <!-- Left Column (Items 1 - 3) -->
        <div class="col-md-6">
            <div class="table-responsive border rounded">
                <table class="table table-sm table-hover align-middle mb-0 text-center" style="font-size: 0.875rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start ps-3" style="width: 55%;">Evaluation Item</th>
                            <th style="width: 15%;"><i class="fas fa-check text-success"></i><br><small class="text-muted" style="font-size: 0.75rem;">Good</small></th>
                            <th style="width: 15%;"><i class="far fa-circle text-warning"></i><br><small class="text-muted" style="font-size: 0.75rem;">Partial</small></th>
                            <th style="width: 15%;"><i class="fas fa-times text-danger"></i><br><small class="text-muted" style="font-size: 0.75rem;">Bad</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item 1 -->
                        <tr>
                            <td class="text-start ps-3">Alarm</td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[alarm_audible]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[alarm_audible]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[alarm_audible]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        </tr>
                        <!-- Item 2 -->
                        <tr>
                            <td class="text-start ps-3">Evacuation plan(updated)</td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[routes_clear]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[routes_clear]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[routes_clear]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        </tr>
                        <!-- Item 3 -->
                        <tr>
                            <td class="text-start ps-3">DRRM team</td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[participants_calm]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[participants_calm]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[participants_calm]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        </tr>
                    <!-- Item 7 -->
                    <tr>
                        <td class="text-start ps-3">Hotline Numbers</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[hotline_numbers]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[hotline_numbers]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[hotline_numbers]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 8 -->
                    <tr>
                        <td class="text-start ps-3">Duck Cover and Hold (ER)</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[duck_cover_and_hold]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[duck_cover_and_hold]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[duck_cover_and_hold]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 9 -->
                    <tr>
                        <td class="text-start ps-3">Command Center</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[command_center]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[command_center]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[command_center]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 10 -->
                    <tr>
                        <td class="text-start ps-3">Student Release Form</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[student_release_form]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[student_release_form]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[student_release_form]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 14 -->
                    <tr>
                        <td class="text-start ps-3">Exit Signage</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[exit_signage]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[exit_signage]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[exit_signage]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 15 -->
                    <tr>
                        <td class="text-start ps-3">BERT/SERT</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[bert_sert]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[bert_sert]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[bert_sert]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 16 -->
                    <tr>
                        <td class="text-start ps-3">Wearing of IDs</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[wear_ids]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[wear_ids]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[wear_ids]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 17 -->
                    <tr>
                        <td class="text-start ps-3">Walked Casually</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[walk_casually]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[walk_casually]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[walk_casually]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Column (Items 4 - 6) -->
        <div class="col-md-6">
            <div class="table-responsive border rounded">
                <table class="table table-sm table-hover align-middle mb-0 text-center" style="font-size: 0.875rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start ps-3" style="width: 55%;">Evaluation Item</th>
                            <th style="width: 15%;"><i class="fas fa-check text-success"></i><br><small class="text-muted" style="font-size: 0.75rem;">Good</small></th>
                            <th style="width: 15%;"><i class="far fa-circle text-warning"></i><br><small class="text-muted" style="font-size: 0.75rem;">Partial</small></th>
                            <th style="width: 15%;"><i class="fas fa-times text-danger"></i><br><small class="text-muted" style="font-size: 0.75rem;">Bad</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item 4 -->
                        <tr>
                            <td class="text-start ps-3">First Aid Kit</td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[first_aid_kit]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[first_aid_kit]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[first_aid_kit]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        </tr>
                        <!-- Item 5 -->
                        <tr>
                            <td class="text-start ps-3">Actual headcount</td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[actual_headcount]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[actual_headcount]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[actual_headcount]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        </tr>
                        <!-- Item 6 -->
                        <tr>
                            <td class="text-start ps-3">Directional Arrows</td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[directional_arrows]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[directional_arrows]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                            <td><input class="form-check-input" type="radio" name="checklist_data[directional_arrows]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        </tr>
                    <!-- Item 11 -->
                    <tr>
                        <td class="text-start ps-3">Attendance Sheet</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[attendance_sheet]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[attendance_sheet]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[attendance_sheet]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 12 -->
                    <tr>
                        <td class="text-start ps-3">Megaphone</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[megaphone]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[megaphone]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[megaphone]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 13 -->
                    <tr>
                        <td class="text-start ps-3">Group Signage</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[group_signage]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[group_signage]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[group_signage]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>   
                    <!-- Item 18 -->
                    <tr>
                        <td class="text-start ps-3">Guard on Duty</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[guard_on_duty]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[guard_on_duty]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[guard_on_duty]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 19 -->
                    <tr>
                        <td class="text-start ps-3">School ID of personnel</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[school_id]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[school_id]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[school_id]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 20 -->
                    <tr>
                        <td class="text-start ps-3">Open Doors(EQ)</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[open_doors]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[open_doors]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[open_doors]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    <!-- Item 21 -->                
                    <tr>
                        <td class="text-start ps-3">Closed Doors(Fire)</td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[closed_doors]" value="check" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[closed_doors]" value="circle" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                        <td><input class="form-check-input" type="radio" name="checklist_data[closed_doors]" value="x" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked; document.getElementsByName(this.name).forEach(r => r !== this ? r.wasChecked = false : null)"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Other Observers -->
<div class="mb-4">
    <label class="form-label fw-bold mb-2">Other Observers Presence</label>
    <div class="row g-3">
        
        <!-- Left Column (Observers 1 - 4) -->
        <div class="col-md-6">
            <div class="table-responsive border rounded">
                <table class="table table-sm table-hover align-middle mb-0 text-center" style="font-size: 0.875rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start ps-3" style="width: 75%;">Observer Group</th>
                            <th style="width: 25%;"><i class="fas fa-check text-success"></i><br><small class="text-muted" style="font-size: 0.75rem;">Present</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Observer 1 -->
                        <tr>
                            <td class="text-start ps-3">Local Barangay</td>
                            <td><input class="form-check-input" type="radio" name="observers_data[local_barangay]" value="present" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked;"></td>
                        </tr>
                        <!-- Observer 2 -->
                        <tr>
                            <td class="text-start ps-3">Philippine National Police (PNP)</td>
                            <td><input class="form-check-input" type="radio" name="observers_data[pnp]" value="present" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked;"></td>
                        </tr>
                        <!-- Observer 3 -->
                        <tr>
                            <td class="text-start ps-3">City DRRM</td>
                            <td><input class="form-check-input" type="radio" name="observers_data[city_drrm]" value="present" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked;"></td>
                        </tr>
                        <!-- Observer 4 -->
                        <tr>
                            <td class="text-start ps-3">Bureau of Fire Protection(BFP)</td>
                            <td><input class="form-check-input" type="radio" name="observers_data[bfp]" value="present" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Column (Observers 5 - 7 + Dynamic Input) -->
        <div class="col-md-6">
            <div class="table-responsive border rounded mb-2">
                <table class="table table-sm table-hover align-middle mb-0 text-center" style="font-size: 0.875rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start ps-3" style="width: 75%;">Observer Group</th>
                            <th style="width: 25%;"><i class="fas fa-check text-success"></i><br><small class="text-muted" style="font-size: 0.75rem;">Present</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Observer 5 -->
                        <tr>
                            <td class="text-start ps-3">PTA / Parent Observers</td>
                            <td><input class="form-check-input" type="radio" name="observers_data[pta_parents]" value="present" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked;"></td>
                        </tr>
                        <!-- Observer 6 -->
                        <tr>
                            <td class="text-start ps-3">OTMPS</td>
                            <td><input class="form-check-input" type="radio" name="observers_data[otmps]" value="present" onclick="this.wasChecked ? (this.checked = false) : null; this.wasChecked = this.checked;"></td>
                        </tr>
                        <!-- Observer 7 (Others Option) -->
                        <tr>
                            <td class="text-start ps-3 fw-bold text-secondary">Others (Please specify)</td>
                            <td>
                                <input class="form-check-input" type="radio" id="observerOthersRadio" name="observers_data[others_present]" value="present" onclick="toggleObserverOthersInput(this, 'observerOthersInputWrapper')">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Dynamic Specification Box -->
            <div id="observerOthersInputWrapper" class="d-none animate-fade-in">
                <input type="text" class="form-control form-control-sm border-primary" name="observers_data[others_specified]" placeholder="Type other agency or observer name here..." disabled>
            </div>
        </div>

    </div>
</div>

<!-- JavaScript for Dynamic "Others" Field Toggle -->
<script>
function toggleObserverOthersInput(radioElement, wrapperId) {
    const wrapper = document.getElementById(wrapperId);
    const inputField = wrapper.querySelector('input');

    // Custom untoggle behavior matching your other rows
    if (radioElement.wasChecked) {
        radioElement.checked = false;
        radioElement.wasChecked = false;
        
        // Hide and clear input
        wrapper.classList.add('d-none');
        inputField.setAttribute('disabled', 'disabled');
        inputField.removeAttribute('required');
        inputField.value = '';
    } else {
        radioElement.wasChecked = true;
        
        // Show and activate input
        wrapper.classList.remove('d-none');
        inputField.removeAttribute('disabled');
        inputField.setAttribute('required', 'required');
        inputField.focus();
    }
}
</script>


                                <div class="modal-footer px-0 pb-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="saveLogBtn">Save Log</button>
                                        </div>