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
    
$('#redeem-points').on({
      input:function(){
        calRemainedPts(this);
      }
});
    
$('#lookup').click(function(){
    var naverdic = 'http://endic.naver.com/search.nhn?sLn=en&searchOption=all&query=';
    var english = $("input[name=english]").val();
    window.open(naverdic+english,'_blank');
    
    return false;
});
$('#lookup_dic').click(function(){
    var dic = 'http://dictionary.reference.com/browse/';
    var english = $("input[name=english]").val();
    window.open(dic+english,'_blank');
    return false;
});
$('#lookup_the').click(function(){
    var dic = 'http://www.thesaurus.com/browse/';
    var english = $("input[name=english]").val();
    window.open(dic+english,'_blank');
    return false;
});

$('#reset').on('click', function(e) {
    e.preventDefault();
    location.reload();
});
    
$( "#checkAnswer" ).click(function( event ) {
  var correctCount = 0;
  var markresult = 0;
  var resulttext;
  var idList = null;
    
  for(var i=1; i<= $('#index').text(); i++) {

    $('tr').show();
    if($('h3#answer_'+i).text() == $('#uanswer_'+i).val()) {
        $( "#result_"+i )
            .text( "Correct" )
            .css('color','#5cb85c');
        correctCount++;
        if (idList == null) {
            idList = $('#uanswer_'+i).prop('name');
        } else {
            idList = idList +","+$('#uanswer_'+i).prop('name');
        }
    } else {
        $( "#result_"+i )
            .text( "Wrong" )
            .css('color','#d9534f');
    }
    $( "#result_"+i ).fadeIn( "slow", function() {});
      
    $( "#result_"+i).animate({
    opacity: 0.3,
    fontSize: "2em",
    }, 1500 );
    
    $('#uanswer_'+i).attr("disabled","disabled");
  }
//calculate mark and set text
  markresult = correctCount/$('#index').text()*100;
  
  if (markresult > 90) {
      resulttext = "Hurrah! Great Job! "+"Your Mark is "+markresult;
  } else if (markresult > 70) {
      resulttext = "Well Done! Good Job! "+"Your Mark is "+markresult;
  } else {
      resulttext = "Oops! Need more practice ^^ "+"Your Mark is "+markresult;
  }
//set correct ID list to send to the server for changing status complete    
  $('#correctIDs').val(idList); 
    
//set mark for input to upload at the server
  $('#finalmarks').val(markresult);
    
//display mark
  $('#mark')
        .text(resulttext)
        .css('color','#428bca');
  $( ".well").fadeIn( "slow", function() {});
  $( ".well").animate({
    opacity: 1,
    fontSize: "2em",
    }, 1500 );

    
//change button     
  $( "#reset" ).removeClass('hidden');
  $( "#submitResult" ).removeClass('hidden');
  $( "#checkAnswer" ).hide();
  return true;
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

function roundToTwo(num) {    
    return +(Math.round(num + "e+1")  + "e-1");
}

function calRemainedPts(form) {
    var remainedPts = $('#remained-points');
    var accuPts = $('#accu-points').val();
    var redeemPts = form.value;
    var sub = roundToTwo(accuPts - redeemPts);
    remainedPts.val(sub);
}

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

