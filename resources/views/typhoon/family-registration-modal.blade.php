{{-- Family Registration Modal --}}
<div class="modal fade" id="familyRegistrationModal" tabindex="-1" aria-labelledby="familyRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('typhoon.families.store') }}" id="familyRegistrationForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header" style="background-color: var(--bg-dark); color: var(--accent-blue); border-bottom: 1px solid var(--glass-border);">
                    <h5 class="modal-title" id="familyRegistrationModalLabel">
                        <i class="fas fa-people-arrows me-2"></i> Register Family Evacuee
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Family Encoding Mode <span class="text-danger">*</span></label>
                            <select name="registration_mode" id="familyRegistrationMode" class="form-select" required>
                                <option value="new" selected>Encode new family</option>
                                <option value="existing">Register existing</option>
                            </select>
                            <input type="hidden" name="existing_family_id" id="existingFamilyId" value="">
                        </div>
                        <div class="col-md-6 d-none" id="existingFamilySelectorWrap">
                            <label class="form-label small fw-bold">Registered Family</label>
                            <select id="existingFamilySelect" class="form-select">
                                <option value="">-- Select existing family --</option>
                            </select>
                            <small class="text-muted">Families registered in any evacuation center are available.</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6 class="fw-bold text-primary"><i class="fas fa-user-tie"></i> Head of Family Details</h6>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label small fw-bold">Full Name (Head) <span class="text-danger">*</span></label>
                            <input type="text" name="head_family_name" id="input_head_name" class="form-control" placeholder="Full name of head" required>
                            <input type="hidden" name="members[0][full_name]" id="hidden_head_name">
                            <input type="hidden" name="members[0][is_head]" value="1">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label small fw-bold">Age <span class="text-danger">*</span></label>
                            <input type="number" name="members[0][age]" class="form-control" placeholder="Age" required min="0" max="150">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label small fw-bold">Gender <span class="text-danger">*</span></label>
                            <select name="members[0][gender]" class="form-select" required>
                                <option value="">Select...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="col-12 vulnerability-wrapper mt-2">
                            <div class="p-2 bg-light rounded border">
                                <label class="form-label fw-bold small mb-1">Head Vulnerabilities / Special Concerns</label>
                                <select class="form-select form-select-sm mb-2 vulnerability-selector">
                                    <option value="">-- Add Concern --</option>
                                    <option value="flagPregnant">Pregnant</option>
                                    <option value="flagPwd">PWD</option>
                                    <option value="flagSenior">Senior Citizen</option>
                                    <option value="flagLactating">Lactating</option>
                                    <option value="flagChild">Child Under 5</option>
                                </select>
                                <div class="vulnerability-tags-container d-flex flex-wrap gap-2"></div>
                                <div class="d-none">
                                    <input class="vulnerability-checkbox flagPregnant" type="checkbox" name="has_pregnant" value="1" id="flagPregnant">
                                    <input class="vulnerability-checkbox flagPwd" type="checkbox" name="has_pwd" value="1" id="flagPwd">
                                    <input class="vulnerability-checkbox flagSenior" type="checkbox" name="has_senior" value="1" id="flagSenior">
                                    <input class="vulnerability-checkbox flagLactating" type="checkbox" name="has_lactating" value="1" id="flagLactating">
                                    <input class="vulnerability-checkbox flagChild" type="checkbox" name="has_child_under5" value="1" id="flagChild">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label class="form-label small fw-bold">Collective Family Needs <span class="text-danger">*</span></label>
                            <div class="family-needs-builder" data-family-needs-builder="create" data-need-options='@json($familyNeedOptions ?? [])' data-existing-needs="[]"></div>
                            <small class="text-muted d-block mt-2">Choose a need and quantity. Selecting <strong>Others Please Specify</strong> reveals a custom field.</small>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-bold mb-0">Other Family Members</label>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-member-btn"><i class="fas fa-plus"></i> Add Member</button>
                    </div>
                    <div id="family-members-container"></div>
                    <hr>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="confirm_check_in" id="confirmCheckIn" checked>
                        <label class="form-check-label" for="confirmCheckIn">Check-in this family now (sets current date/time)</label>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="col-12">
                        <label class="form-label fw-bold small text-uppercase text-muted">Evacuation Center / School <span class="text-danger">*</span></label>
                        <div id="lockedCenterHint" class="small text-primary mb-1 d-none"><i class="fas fa-lock me-1"></i> Locked to selected evacuation center.</div>
                        <select name="evacuation_center_id" id="modal_evacuation_center_id" class="form-select" required>
                            <option value="">-- Select Evacuation Center --</option>
                            @foreach($evacuationCenters ?? [] as $ec)
                                <option value="{{ $ec->id }}">{{ $ec->school_name ?? $ec->identification ?? ('Evacuation Center #' . $ec->id) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small text-uppercase text-muted">Building <span class="text-danger">*</span></label>
                        <select name="building_id" id="firesafety_buildings" class="form-select" required><option value="">-- Select Building --</option></select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold small text-uppercase text-muted">Room <span class="text-danger">*</span></label>
                        <select name="room_id" id="fire_safety_rooms" class="form-select" required><option value="">-- Select Room --</option></select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" style="background-color: #1B4C6D; color: white;"><i class="fas fa-save"></i> Register Family</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
(() => {
    const existingFamiliesByCenter = @json($existingFamiliesByCenter ?? []);

    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('familyRegistrationModal');
        const form = document.getElementById('familyRegistrationForm');
        if (!modal || !form) return;

        const centerSelect = document.getElementById('modal_evacuation_center_id');
        const buildingSelect = document.getElementById('firesafety_buildings');
        const roomSelect = document.getElementById('fire_safety_rooms');
        const modeSelect = document.getElementById('familyRegistrationMode');
        const existingWrap = document.getElementById('existingFamilySelectorWrap');
        const existingSelect = document.getElementById('existingFamilySelect');
        const existingId = document.getElementById('existingFamilyId');
        const members = document.getElementById('family-members-container');
        const addMember = document.getElementById('add-member-btn');
        const headName = document.getElementById('input_head_name');
        const hiddenHeadName = document.getElementById('hidden_head_name');
        let memberIndex = 1;

        const allFamilies = () => {
            const unique = new Map();
            Object.values(existingFamiliesByCenter || {}).flat().forEach(family => {
                if (family?.id != null) unique.set(String(family.id), family);
            });
            return [...unique.values()];
        };

        const escapeHtml = value => String(value ?? '').replace(/[&<>'"]/g, char => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;'
        }[char]));

        function initializeNeeds(needs = []) {
            const builder = form.querySelector('.family-needs-builder');
            if (!builder) return;
            const options = JSON.parse(builder.dataset.needOptions || '[]');
            builder.innerHTML = '';
            let index = 0;
            const addNeed = (need = {}) => {
                const selected = need.need_name || '';
                const custom = selected && !options.includes(selected);
                const row = document.createElement('div');
                row.className = 'row g-2 mb-2 family-need-row';
                row.innerHTML = `<div class="col-md-6"><select class="form-select" name="needs[${index}][need_name]" required><option value="">-- Select need --</option>${options.map(option => `<option value="${escapeHtml(option)}">${escapeHtml(option)}</option>`).join('')}<option value="Others Please Specify">Others Please Specify</option></select></div><div class="col-md-3"><input type="number" class="form-control" name="needs[${index}][quantity]" min="1" value="${need.quantity || 1}" required></div><div class="col-md-3"><button type="button" class="btn btn-outline-danger w-100">Remove</button></div><div class="col-12 custom-need ${custom ? '' : 'd-none'}"><input type="text" class="form-control" name="needs[${index}][custom_need]" placeholder="Please specify other need" value="${escapeHtml(custom ? selected : '')}"></div>`;
                const select = row.querySelector('select');
                const customWrap = row.querySelector('.custom-need');
                const customInput = row.querySelector('input[name$="[custom_need]"]');
                select.value = custom ? 'Others Please Specify' : selected;
                customInput.required = custom;
                select.addEventListener('change', () => {
                    const isOther = select.value === 'Others Please Specify';
                    customWrap.classList.toggle('d-none', !isOther);
                    customInput.required = isOther;
                    if (isOther && row === builder.lastElementChild) addNeed();
                });
                row.querySelector('button').addEventListener('click', () => {
                    if (builder.children.length > 1) row.remove();
                    else { select.value = ''; customInput.value = ''; customWrap.classList.add('d-none'); }
                });
                builder.appendChild(row);
                index++;
            };
            needs.forEach(addNeed);
            addNeed();
        }

        function addMemberRow(member = {}) {
            const row = document.createElement('div');
            row.className = 'row g-2 mb-3 member-row border-bottom pb-3';
            row.innerHTML = `<div class="col-md-6"><label class="form-label small fw-bold">Full Name *</label><input class="form-control" name="members[${memberIndex}][full_name]" value="${escapeHtml(member.full_name)}" required></div><div class="col-md-3"><label class="form-label small fw-bold">Age *</label><input type="number" class="form-control" name="members[${memberIndex}][age]" value="${escapeHtml(member.age)}" min="0" required></div><div class="col-md-3"><label class="form-label small fw-bold">Gender *</label><select class="form-select" name="members[${memberIndex}][gender]" required><option value="">Select...</option><option value="male">Male</option><option value="female">Female</option></select></div><div class="col-12 text-end"><button type="button" class="btn btn-outline-danger btn-sm">Remove Member</button></div><input type="hidden" name="members[${memberIndex}][is_head]" value="0">`;
            row.querySelector('select').value = member.gender || '';
            row.querySelector('button').addEventListener('click', () => row.remove());
            members.appendChild(row);
            memberIndex++;
        }

        function clearDetails() {
            form.querySelectorAll('input, textarea').forEach(input => {
                if (input.type !== 'hidden' || ['existingFamilyId', 'hidden_head_name'].includes(input.id)) input.value = '';
            });
            form.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            form.querySelectorAll('.vulnerability-checkbox').forEach(input => input.checked = false);
            members.innerHTML = '';
            memberIndex = 1;
            existingId.value = '';
            initializeNeeds();
        }

        function refreshFamilies() {
            if (!existingSelect) return;
            existingSelect.innerHTML = '<option value="">-- Select registered family --</option>';
            allFamilies().forEach(family => {
                const option = document.createElement('option');
                option.value = family.id;
                option.textContent = `#${family.id} - ${family.head_family_name || 'Unnamed family'}${family.checked_out_at ? ' (History)' : ''}`;
                existingSelect.appendChild(option);
            });
        }

        function fillFamily(family) {
            const familyMembers = Array.isArray(family.members) ? family.members : [];
            const head = familyMembers.find(member => member.is_head) || familyMembers[0];
            headName.value = head?.full_name || family.head_family_name || '';
            hiddenHeadName.value = headName.value;
            form.querySelector('input[name="members[0][age]"]').value = head?.age || '';
            form.querySelector('select[name="members[0][gender]"]').value = head?.gender || '';
            familyMembers.filter(member => !member.is_head).forEach(addMemberRow);
            ['pregnant', 'pwd', 'senior', 'lactating', 'child_under5'].forEach(flag => {
                const input = form.querySelector(`[name="has_${flag}"]`);
                if (input) input.checked = !!family[`has_${flag}`];
            });
            existingId.value = family.id;
            initializeNeeds(family.needs || []);
        }

        async function loadBuildings() {
            if (!buildingSelect || !centerSelect.value) return;
            buildingSelect.innerHTML = '<option value="">-- Loading Buildings --</option>';
            roomSelect.innerHTML = '<option value="">-- Select Room --</option>';
            try {
                const response = await fetch(`/fire-safety/buildings/${centerSelect.value}`);
                const buildings = await response.json();
                buildingSelect.innerHTML = '<option value="">-- Select Building --</option>';
                buildings.forEach(building => buildingSelect.add(new Option(`${building.building_no}${building.building_name ? ` - ${building.building_name}` : ''}`, building.id)));
            } catch { buildingSelect.innerHTML = '<option value="">-- Error loading buildings --</option>'; }
        }

        async function loadRooms() {
            if (!roomSelect || !buildingSelect.value) return;
            roomSelect.innerHTML = '<option value="">-- Loading Rooms --</option>';
            try {
                const response = await fetch(`/fire-safety/rooms/${buildingSelect.value}`);
                const rooms = await response.json();
                const evacRooms = rooms.filter(room => room.Main_evac || room.Buffer_evac || room.is_evacuation_room);
                roomSelect.innerHTML = evacRooms.length ? '<option value="">-- Select Room --</option>' : '<option value="">No evacuation rooms found</option>';
                evacRooms.forEach(room => roomSelect.add(new Option(`${room.room_code || 'Room'}${room.room_name ? ` - ${room.room_name}` : ''}`, room.id)));
            } catch { roomSelect.innerHTML = '<option value="">-- Error loading rooms --</option>'; }
        }

        headName?.addEventListener('input', () => { hiddenHeadName.value = headName.value; });
        addMember?.addEventListener('click', () => addMemberRow());
        centerSelect?.addEventListener('change', loadBuildings);
        buildingSelect?.addEventListener('change', loadRooms);
        modeSelect?.addEventListener('change', () => {
            const existing = modeSelect.value === 'existing';
            existingWrap?.classList.toggle('d-none', !existing);
            clearDetails();
            if (existing) refreshFamilies();
        });
        existingSelect?.addEventListener('change', () => {
            const family = allFamilies().find(item => String(item.id) === existingSelect.value);
            if (family) { clearDetails(); fillFamily(family); }
        });
        modal.addEventListener('show.bs.modal', event => {
            clearDetails();
            modeSelect.value = 'new';
            existingWrap?.classList.add('d-none');
            const centerId = event.relatedTarget?.dataset.ecId;
            if (centerId) {
                centerSelect.value = centerId;
                centerSelect.dataset.lockedValue = centerId;
                centerSelect.style.pointerEvents = 'none';
                document.getElementById('lockedCenterHint')?.classList.remove('d-none');
                loadBuildings();
            }
            refreshFamilies();
        });
    });
})();
</script>
