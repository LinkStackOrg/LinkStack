var copyToClipboard = (function () { 
  var copyIcon = document.querySelector(".copy-icon");
  var toastBox =  document.querySelector(".toastbox");
  var pageUrl= window.location.href;

    function isCopying(string) { // text to copy 
      var textarea, result;
        try {
            textarea = document.createElement('textarea');
            textarea.setAttribute('readonly', true);
            textarea.setAttribute('contenteditable', true);
            textarea.style.position = 'fixed'; 
            textarea.value = string;

            document.body.appendChild(textarea);

            textarea.select();

            var range = document.createRange();
            range.selectNodeContents(textarea);

            var selectedText = window.getSelection();
            selectedText.removeAllRanges();
            selectedText.addRange(range);

            textarea.setSelectionRange(0, textarea.value.length);
            result = document.execCommand('copy');
        } catch (err) {
            console.error(err);
            result = null;
        } finally {
            document.body.removeChild(textarea);
        }
        // manual copy fallback using prompt
        if (!result) {
            result = prompt("Copy the link", string); // eslint-disable-line no-alert
            if (!result) {
                return false;
            }
        }
        return true;
    }
  
  function showToastBox (message) {
        toastBox.textContent = message;
        setTimeout(function () {
            toastBox.classList.add("toast-tox--active");
        }, 500)
        setTimeout(function () {
            toastBox.classList.remove("toast-tox--active");
        }, 3000)
    }
    function handleCopyIconClick() {
  copyIcon.addEventListener("click", function(){
    showToastBox(isCopying(pageUrl) ? "URL was copied to your clipboard" : "Unable to copy");
})
}

  
    return {handleCopyIconClick: handleCopyIconClick}
})();

copyToClipboard.handleCopyIconClick();

$('#share-share-button').on('click', () => {
  if (navigator.share) {
    navigator.share({
        title: '',
        text: '',
        url: '',
      })
      .then(() => console.log('Successful share'))
      .catch((error) => console.log('Error sharing', error));
  } else {
    console.log('Share not supported on this browser, do it the old way.');
  }
});