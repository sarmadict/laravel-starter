{{-- Start : Regular Alerts --}}
@foreach($alerts->all() as $alert)
    <div class="alert alert-{{ $alert->severity }}">
        <button data-ct-dismiss="alert" class="close">×</button>
        {{ $alert }}
    </div>
@endforeach
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