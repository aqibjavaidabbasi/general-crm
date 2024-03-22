<div>
    @if (Session::has('alert'))
        @dd('session')
        <script>
            var messageType = "{{ session('alert')['type'] ?? 'success' }}";
            var messageText = "{{ session('alert')['message'] }}";

            Swal.fire(
                messageText,
                '',
                messageType
            )
        </script>
    @endif
</div>
