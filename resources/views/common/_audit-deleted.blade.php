<div class="modal fade" id="modal_deleted_audits" data-bs-backdrop="static" aria-labelledby="modal-deleted-audits-label" aria-hidden="true">
    <div class="modal-dialog modal-xl animated pulse">
        <div class="modal-content">
            <div class="modal-header pb-0" style="border-bottom: none;">
                <h5 class="modal-title text-secondary" id="modal-deleted-audits-label">{{__('Deleted Audit')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <div class="table-responsive">
                    <table id="table_deleted_audits" class="table table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Event') }}</th>
                                <th>{{ __('Information') }}</th>
                                <th>{{ __('IP adress') }}</th>
                                <th>{{ __('Timestamp') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fs-rem-85">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer pt-0" style="border-top: none;">
                <x-fc-button-close label="Close" icon="fas fa-times" />
            </div>
        </div>
    </div>
</div>

@push('partialjs')
<script>
    // Abre el modal y carga solo los eventos deleted
    function showDeletedAudits(audits) {
        const deletedAudits = audits.filter(a => a.event === 'deleted');
        const $tbody = $('#table_deleted_audits tbody');
        $tbody.empty();
        if (deletedAudits.length === 0) {
            $tbody.append('<tr><td colspan="4" class="text-center">{{ __('No deleted records found') }}</td></tr>');
        } else {
            deletedAudits.forEach(audit => {
                $tbody.append(`
                    <tr>
                        <td>${audit.user ? audit.user.name : ''}</td>
                        <td>${audit.event}</td>
                        <td>${audit.ip_address || ''}</td>
                        <td>${audit.created_at || ''}</td>
                    </tr>
                `);
            });
        }
        $('#modal_deleted_audits').modal('show');
    }
</script>
@endpush

