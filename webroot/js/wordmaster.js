$(document).ready(function(){

window.onload = function() {
    $body = document.getElementById('body');
    if ($body != null)
	   showCounter($body);
};

$('#body').on({
      input:function(){
        showCounter(this);
      }
});

$( ":checkbox" ).click(function(){
    var checkedString = [];
    var merged;
    $.each($("input[name='tags[_ids][]']:checked"), function(){  
        checkedString.push($(this.nextSibling.textContent).selector);
    });
    $("input[name ='tag_string'").val(checkedString.join(", "));
});

});

function wordCounter( val ){
    return {
        charactersNoSpaces : val.replace(/\s+/g, '').length,
        characters         : val.length,
        words              : val.match(/\S+/g).length,
        lines              : val.split(/\r*\n/).length
    }
}

function showCounter(form) {
    var $wordCount = $('#word_statistic');
    if (form.form == null) {
        var c = wordCounter(form.innerText);
    } else {
        var c = wordCounter(form.value);
    }

    $wordCount.html(
      "Characters: "+ c.charactersNoSpaces +
      "<br>Words: "+ c.words +
      ", Lines: "+ c.lines
    );
}
