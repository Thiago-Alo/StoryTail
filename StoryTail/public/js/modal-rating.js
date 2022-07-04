
    const lastModalOpen = document.querySelector('[data-last-modal="open"]');
    const lastModalContainer = document.querySelector('[data-last-modal="container"]');
    const lastModalClosed = document.querySelector('[data-last-modal="closed"]');
    function openLastModal(event){
    event.preventDefault();
    lastModalContainer.classList.add('ativo')
}
    function closeLastModal(event){
    event.preventDefault();
    lastModalContainer.classList.remove('ativo')
}
    lastModalOpen.addEventListener('click', openLastModal)
    lastModalClosed.addEventListener('click', closeLastModal)


type="text/javascript">
    $(document).ready(function(){
    var ratingCheck = $('.ratingCheck');
    ratingCheck.change(function(){
    if($('.ratingCheck input')!=null) {
    ratingCheck.removeAttr('required');
} else {
    ratingCheck.attr('required', 'required');
}
});
});
