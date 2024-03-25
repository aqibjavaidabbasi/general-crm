<div>

    @if(Session::has('alert'))
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script>
        var messageType = "{{ session('alert')['type'] ?? 'success' }}";
        var messageText = "{{ session('alert')['message'] }}";

        console.log(messageType,messageText)
        Swal.fire(
            messageText,
            '',
            messageType
            )
            </script>
            @dd(session()->all())

    @endif
</div>
