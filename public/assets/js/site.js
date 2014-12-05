/**
 * Created by jmolnar on 10/7/2014.
 */
(function(){

    var dropDownCount, clonedMenu, deleteProgramButton;
    if(document.querySelector('.program_dropdown') != null){

        deleteProgramButton = $('.delete_program');
        clonedMenu = document.querySelector('.program_dropdown').outerHTML;
        dropDownCount = document.querySelectorAll('.program_dropdown').length;

        /*
         *  Set the initial visibility of the delete button
         */
        dropDownCount < 2 ? deleteProgramButton.css('display', 'none') : deleteProgramButton.css('display', 'inline-block');

        /*
         *  Add program dropdown
         */
        $('.add_program').on('click', function(e){
            $('.program_dropdown').last().after(clonedMenu+'<br/>');
            dropDownCount++;
            if(dropDownCount > 1){
                $('.delete_program').css('display', 'inline-block');
            }
            console.log(dropDownCount);
            e.preventDefault();
        });

        /*
         *  Delete program dropdown
         */
        deleteProgramButton.on('click', function(e){
            $('.program_dropdown').last().remove();
            dropDownCount--;
            if (dropDownCount == 1){
                $(this).css('display', 'none');
            }
            console.log(dropDownCount);

            e.preventDefault();
        });
    }





})();
