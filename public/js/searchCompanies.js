
$(document).ready(function(){
    $('#search').keyup(function(){
        var query = $(this).val();
        $.ajax({
            url: 'http://localhost/internarc/companies/SearchCompanies',
            type: 'post',
            data: {query: query},
            success: function(response){
                $('#view-companies-table-container').html(response);
            }
        });
    });
});
