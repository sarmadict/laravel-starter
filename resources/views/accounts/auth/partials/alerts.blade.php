{{-- Start : Regular Alerts --}}

@foreach(['debug' => 'info', 'info' => 'info', 'notice' => 'info', 'warning' => 'warning', 'error' => 'danger', 'critical' => 'danger', 'alert' => 'info', 'emergency' => 'danger', 'success' => 'success'] as $severity => $class)
    @if($alerts->has($severity))
        @foreach($alerts->get($severity) as $alert => $class)
            <div class="alert alert-{{ $class }}">
                <button data-ct-dismiss="alert" class="close">×</button>
                {{ $alert }}
            </div>
        @endforeach
    @endif
@endforeach
{{-- End : Regular Alerts --}}


{{-- Start : SweetAlert Alerts --}}
@if($alerts->sweetAlert->count() > 0)
    @foreach($alerts->sweetAlert->all() as $alert)
        @push('scripts')
            <script>
                $(document).ready(function(){
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