var articleId = null;
var downloadModel = {};

function bind ()
{
    $('body').on('click', '#showModal', showModalDelete);
    $('body').on('click', '#deleteFile',  deleteFile);
}

function showModalDelete () 
{
   
    $("#modal").modal('show');
    articleId = $(this).data('article');
    downloadModel = $(this).data('download');  
    $("#titleMod").text(downloadModel.title);

}

// Удаляем файл в не зависимости от публикации
function deleteFile ()
{  
   
   axios({
       method: 'delete',
       url:'../../download/'+downloadModel.id,
       data:{ id:articleId }
   })
        .then(function (response) {  
            
            $("#titleMod").text(response.data.result); 
            setTimeout(function() { $("#modal").modal('hide') }, 1000);

            // Скрываем div с удаленным файлом, либо div со всей формой
            if(response.data.countFiles == 0)
            {
                $(".file-foot").addClass('d-none');
            }else 
            {
                $("#"+downloadModel.id).addClass('d-none');
            }
        })  
        .catch (error=> {
            if (error.response.status == 422) {
                this.errors = error.response.data.errors
            }
        });
}

bind();