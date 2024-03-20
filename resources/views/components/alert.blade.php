<div>
    @if(Session::has('alert'))
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
