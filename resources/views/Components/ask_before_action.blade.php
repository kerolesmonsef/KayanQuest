<?php
/** @var  string $fire_button_class */
/** @var  string $modal_class */
/** @var  string $crsf */
/** @var  string $method_in_form */

$form_ID = "Form_ID" . rand();
?>
<div class="modal fade {{ $modal_class }}" id="{{ "Modal_ID".rand() }}" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <p>{!!  $message ?? "Are You Sure ?"  !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="#" method="{{ $method ?? "POST" }}" id="{{$form_ID}}">
                    {{ $crsf ?? "" }}
                    {{ $method_in_form ?? "" }}
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// variables names
$fire_button_class_class = "fire_button_class_class" . rand();
$form_ID_el = "form_ID_el" . rand();
$the_buttons = "the_buttons" . rand();
?>

<script type="application/javascript">
    var {{$fire_button_class_class}} =
    "{{ $fire_button_class }}";
    var {{$form_ID_el}} =
    "{{ $form_ID }}";

    var {{$the_buttons}} =
    document.getElementsByClassName({{$fire_button_class_class}});

    Array.from({{$the_buttons}}).forEach(function (item) {
        item.onclick = () => {
            var the_action_form = document.getElementById({{$form_ID_el}});
            var url_to_action = item.getAttribute("data-delete-url");
            the_action_form.setAttribute("action", url_to_action);
            // alert(url_to_action)
        }
    });

</script>
