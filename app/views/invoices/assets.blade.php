@section('styles') 
{{ HTML::style('assets/lib/bootstrap-datepicker/css/datepicker3.css'); }}
@stop
@section('modals') 
@include('billers/modal')
@include('clients/modal')
@include('tax_rates/modal')
@stop
@section('scripts')
{{ HTML::script('assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js'); }}
{{ HTML::script('assets/js/calc.js'); }}
<script type="text/javascript">
    $(document).ready(function() {
        @if (isset($invoice))
            var client_id = $('#client_id option:selected').val();
            $.get("{{ URL::to('clients/') }}/" + client_id, function(data) {
                if (data.status === "success") {
                    $("#client-info").append(address(data));
                }
            });
            var biller_id = $('#biller_id option:selected').val();
            $.get("{{ URL::to('billers/') }}/" + biller_id, function(data) {
                if (data.status === "success") {
                    $("#biller-info").append(address(data));
                     $(".logo").empty();
                     $(".logo").append(logo(data));
                }
            });
        @endif 
        if ($(".delete").length > 1){
            $(".delete").show()
        } 
        else {
            $(".delete").hide();
        }       
        $('.datepicker').datepicker({
            clearBtn: true,
        })
        $('#biller_id').on('change', function(e) {
            var id = $('#biller_id').val();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "{{ URL::to('billers/') }}/" + id,
                success: function(data) {
                    // Check for a valid server side response
                    if (data.status === "success") {
                        $("#biller-info").empty();
                        $("#biller-info").append(address(data));
                        $(".logo").empty();
                        $(".logo").append(logo(data));
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert("Something went wrong. Please Try again later...");
                }
            });
        });
        $('#client_id').on('change', function(e) {
            var id = $('#client_id').val();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "{{ URL::to('clients/') }}/" + id,
                success: function(data) {
                    // Check for a valid server side response
                    if (data.status === "success") {
                        $("#client-info").empty();
                        $("#client-info").append(address(data));
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert("Something went wrong. Please Try again later...");
                }
            });
        });
        $('#currency_id').on('change', function() {
            $(".currency").empty();
            $(".currency").append($('option:selected', $(this)).text());
        });
        $('input').click(function() {
            $(this).select();
        });

        $("#number").blur(function() {
            $(".number").replaceWith($(this).val());
        });

        $("#paid").blur(update_balance);
        $("#tax_rate").change(update_total);

        // Add new items row to invoice
        $("#addrow").click(function() {
            $(".item-row:last").after('<tr class="item-row"><input type="hidden" name="item_id[]" value=""><td class="item-name"><div class="delete-wpr"><input type="text" class="form-control item-name" placeholder="Item name" name="item_name[]" value=""><a class="delete btn btn-danger"  title="Remove row"><i class="fa fa-remove"></i></span></a></div></td><td class="description"><textarea class="form-control" name="item_description[]" rows="1" placeholder="Item description" id="itemDescription"></textarea></td><td><input type="text" class="cost form-control" name="item_price[]" id="itemPrice" placeholder="0.00"></td><td><input type="text" class="qty form-control" value="" name="item_qty[]" placeholder="0" id="itemQty"></td><td align="right"><span class="item_total">$0.00</span></td></tr>');
            if ($(".delete").length > 0)
                $(".delete").show();
            bind();
        });

        bind();

        $(document).on("click", "a.delete", function() {
            $(this).parents('.item-row').remove();
            update_total();
            if ($(".delete").length < 2)
                $(".delete").hide();
        });       
         // New biller
        $('.new-biller').click(function() {
            var message = $(this).attr('data-content');
            var title = $(this).attr('data-title');
            $('#biller_modal_label').text(title);;
            $('#biller_modal').modal({show: true});
           return false;
        }); 
        $( "#save-biller" ).click(function() {
              $.ajax({
                type: "POST",
                dataType: 'json',
                url: "{{ URL::to('billers') }}",     
                data: $('form#create_biller').serialize(),
                 beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },               
                success: function(data) {
                    $(".help-block").hide();
                    $(".form-group").removeClass("has-error");
                    if (data.status === "success") {
                        console.log(data);
                        $('#dataConfirmModal').modal('hide');
                        location.reload()                    
                    }  
                    else {
                        if (data.errors.name)
                        $("#biller_name").after("<span class='help-block'>" + data.errors.name + "</span>").parent().addClass("has-error");
                        if (data.errors.email)
                        $("#biller_email").after("<span class='help-block'>" + data.errors.email + "</span>").parent().addClass("has-error");
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert("Something went wrong. Please Try again later...");
                }
            });            
            return false;
        }); 
        // New client
          $('.new-client').click(function() {
            var message = $(this).attr('data-content');
            var title = $(this).attr('data-title');
            $('#client_modal_label').text(title);;
            $('#client_modal').modal({show: true});
           return false;
        }); 
        $( "#save-client" ).click(function() {
              $.ajax({
                type: "POST",
                dataType: 'json',
                url: "{{ URL::to('clients') }}",     
                data: $('form#create_client').serialize(),
                 beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },               
                success: function(data) {
                    $(".help-block").hide();
                    $(".form-group").removeClass("has-error");
                    if (data.status === "success") {
                        console.log(data);
                        $('#dataConfirmModal').modal('hide');
                        location.reload()                    
                    }  
                    else {
                        if (data.errors.name)
                        $("#client_name").after("<span class='help-block'>" + data.errors.name + "</span>").parent().addClass("has-error");
                        if (data.errors.email)
                        $("#client_email").after("<span class='help-block'>" + data.errors.email + "</span>").parent().addClass("has-error");
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert("Something went wrong. Please Try again later...");
                }
            });            
            return false;
        }); 
        // New tax
        $('.new-tax').click(function() {
            var message = $(this).attr('data-content');
            var title = $(this).attr('data-title');
            $('#tax_modal_label').text(title);;
            $('#tax_modal').modal({show: true});
           return false;
        }); 
        $("#create-tax").click(function(){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "{{ URL::to('tax_rates/create') }}",     
                data: $('form#create_tax').serialize(),
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },               
                success: function(data) {
                    $(".help-block").hide();
                    $(".form-group").removeClass("has-error");
                    if (data.status === "success") {
                        console.log(data);
                        $('#dataConfirmModal').modal('hide');
                        location.reload()                    
                    }  
                    else {
                        if (data.errors.name)
                        $("#tax_name").after("<span class='help-block'>" + data.errors.name + "</span>").parent().addClass("has-error");
                         if (data.errors.rate)
                        $("#rate").after("<span class='help-block'>" + data.errors.rate + "</span>").parent().addClass("has-error");
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert("Something went wrong. Please Try again later...");
                }
            });
              return false;
        });       
 
    });
</script>
@stop