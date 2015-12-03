function go(qq,$c,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11) {
var request_uri = location.search;
var res = request_uri.substr(6);
var page = "pages/" + res + ".php";
var c = $c;
var c2 = $c2;
var c3 = $c3;
var c4 = $c4;
var c5 = $c5;
var c6 = $c6;
var c7 = $c7;
var c8 = $c8;
var c9 = $c9;
var c10 = $c10;
var c11 = $c11;
  $.ajax({
    type: "POST",
    url: page,
    data: {
      c: $(c).val(),c2: $(c2).val(),c3: $(c3).val(),c4: $(c4).val(),c5: $(c5).val(),c6: $(c6).val(),c7: $(c7).val(),c8: $(c8).val(),c9: $(c9).val(),c10: $(c10).val(),c11: $(c11).val()
    },
    success: function(data) {
      $(qq).html(data);
    }
  });
}