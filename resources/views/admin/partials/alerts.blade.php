{{-- Start : Regular Alerts --}}
@if($alerts->count() > 0)
    <div class="container-fluid container-fullw bg-white padding-top-10 padding-bottom-0">
        @foreach($alerts->all() as $alert)
            <div class="alert alert-{{ $alert->getSeverityClass() }}">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $alert }}
            </div>
        @endforeach
    </div>
@endif
{{-- End : Regular Alerts --}}


{{-- Start : SweetAlert Alerts --}}
@if($alerts->sweetAlert->count() > 0)
    @foreach($alerts->sweetAlert->all() as $alert)
        @push('scripts')
        <script>
            $(document).ready(function () {
                swal({
                    title: "{{ $alert->title }}",
                    text: "{{ $alert->description }}",
                    icon: "{{ $alert->severity }}",
                    showCancelButton: Boolean({{ $alert->showCancelButton }}),
                    confirmButtonColor: '{{ $alert->confirmButtonColor }}',
                    confirmButtonText: '{{ $alert->confirmButtonText }}',
                    cancelButtonText: '{{ $alert->cancelButtonText }}',
                    closeOnConfirm: Boolean({{ $alert->closeOnConfirm }}),
                    closeOnCancel: Boolean({{ $alert->closeOnCancel }})
                });
            });
        </script>
        @endpush
    @endforeach
@endif
{{-- End : SweetAlert Alerts --}}