<div>
    @if (Session::has('alert'))
        <script>
            $(document).ready(function() {
                var messageType = "{{ session('alert')['type'] ?? 'success' }}";
                var messageText = "{{ session('alert')['message'] }}";

                console.log(messageType, messageText);
                Swal.fire(
                    messageText,
                    '',
                    messageType
                );
            });
        </script>
        @php
            Log::info(session()->all());
        @endphp
    @endif
</div>
