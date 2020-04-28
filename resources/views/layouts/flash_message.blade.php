@if(session()->has('message'))
    <script>
        alert('{{ session()->get('message') }}');
    </script>
@endif
