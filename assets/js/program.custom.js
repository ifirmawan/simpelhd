$(document).ready(function() {
    var url_action= $('span.url_act').text();

    if ($('i.val-op-step').length == 1) {
        var isiclass = $('i.val-op-step').text();
        $('.option-uniq').addClass(isiclass);
    };
    $(document).on('change','.cekpwineg',function(){
        if ($(this).is(':checked')) {
            $('select[name="pegi"]').css('display','block');
            $('select[name="nopegi"]').css('display','none');
        }else{
            $('select[name="pegi"]').css('display','none');
            $('select[name="nopegi"]').css('display','block');
        }
    });
    $(document).on('change','select[name="kelainan_fisik"]',function(){
      if ($(this).val() == 2) {
          $('div.pycct').show();
          //$('select[name="penyandang_cacat"]').css('display','block');
      }else{
          $('div.pycct').hide();
          //$('select[name="penyandang_cacat"]').css('display','none');
      }
    });
    $(document).on('keypress keydown','.submit-editable',function(event){
      
      var kunci     = $(this).attr('name');      
      var idne      = $(this).attr('id');
      var keycode   = (event.keyCode ? event.keyCode : event.which);
      var kirim     = {'id' : idne};
      kirim[kunci]  = $(this).val();
      if(keycode == '13' || keycode == '9'){
          updatePerson(kirim);
      }
    });
    $('input.tgl-step').change(function(){
        //var inputDate = new Date(this.value); //full
        var kunci     = $(this).attr('name');      
        var id        = $(this).attr('id');
        var kirim     = {'id' : id };
        kirim[kunci]  = this.value;
        updatePerson(kirim); 
        //location.reload();
    });
    $(document).on('change','select.op-step',function(){
        var kunci     = $(this).attr('name');      
        var kirim     = {'id' : $(this).attr('id') };
        kirim[kunci]  = this.value;
        updatePerson(kirim);
        //alert(this.value);
    });
    $.getJSON(url_action+'/ajax_request/get_job_json', function(data){
        //if($('.auto-person-job').length == 1){
          $('.auto-person-job').each(function() {
            var $this = $(this);
            $this.typeahead({
                source :data
                ,onselect: function(obj){
                  var kunci     = $this.attr('name');      
                  var kirim     = {'id' : $this.attr('id') };
                  kirim[kunci]  = obj;
                  updatePerson(kirim);
                  //console.log(kirim);
                }
            });
          });
        //}
    });
    $(document).on('click','a.link-new-jml-kel',function(){
      $('div.new-jml-kel').css('display','block');
      $(this).addClass('link-close-new-jml-kel');
      $(this).text('Batal');
    });
    $(document).on('click','a.link-close-new-jml-kel',function(){
      $(this).text('Ya');
      $(this).removeClass('link-close-new-jml-kel');
      $('div.new-jml-kel').css('display','none');
    });
    $(document).on('click','button.btn-new-jml-kel',function(){
      var jml_anggota = $('input[name="jml_anggota"]').val();
      var kepkel_id   = $('input[name="kepkel_id"]').val();
      $.ajax({
          url: url_action+'/ajax_request/update_jml_kel',
          data: {'id': kepkel_id , 'jml_anggota': jml_anggota },
          type:"POST",
          success: function(data){
              if (data == '1') {
                location.reload();
              }else{
                alert(data);
              }
          }
      });
      
    });
    
    //name="jml_anggota"
});

function updatePerson(kirim){
      var url_action= $('span.url_act').text();
      $.ajax({
          url: url_action+'/ajax_request/edit_person_byone',
          data: kirim,
          type:"POST",
          dataType:"json",
          success: function(data){
              //location.reload();
              //console.log(data);
          }
      });
}
