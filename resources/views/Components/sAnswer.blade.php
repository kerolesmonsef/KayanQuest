<div style="{{ $ansStyle ?? "" }}"
     class="p-3 m-2 answerdiv"
    {{ $onclick ?? "" }}
>
        <span style="{{ $box_style ?? "" }}">
            <b>{{ $number ?? 0 }}</b>
        </span>
    <span> <b>{{ $content ?? "" }}</b> </span>
</div>
