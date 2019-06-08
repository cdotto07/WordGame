/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $(function () {
        $("#comp ul").sortable({
            opacity: 0.6,
            cursor: 'move',
            update: function () {
                chosenWord(currentPic);
            }});
    });

    $(function () {
        $("#word ul").sortable({
            opacity: 0.6,
            cursor: 'move'
        });
    });
    //Make second and third box sortable
    $(function () {
        $("#sortable1, #sortable2").sortable(
                {connectWith: ".sortBox"})
                .disableSelection();
    });

//Compare chosen word and image
    function chosenWord(currentPic, ) {

    }
});
