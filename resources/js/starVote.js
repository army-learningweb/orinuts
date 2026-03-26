export default function starVote(){
    $(document).on('click','.star',function(){
        let starVote = $(this).data('vote-num');
        
        $(this).removeClass('fa-regular');
        $(this).addClass('fa-solid');

        $(this).prevAll().removeClass('fa-regular'); 
        $(this).prevAll().addClass('fa-solid'); 
        
        $(this).nextAll().removeClass('fa-solid');
        $(this).nextAll().addClass('fa-regular'); 

        $('.star-num').html(`(${starVote} sao)`)
        $('.star-vote').val(starVote);

        $('.status_failed').remove();
    })
}