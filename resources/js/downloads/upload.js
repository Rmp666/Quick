//var upload = (function() {

    var fileInputClone = {};
    var countFiles = 1;
    
    function bind ()
    {
        $('body').on('click', '#addFile', addUpload);
        $('body').on('change', '.custom-file-input',  changeLabelName);
        $('body').on('click', '#notFile', cancelUpload);
        $('body').on('click', '#addMoreFiles', addFileInput);
        $('body').on('click', '[data-file]', removeFileInput);
        $('body').on('click', '#download', validateArticle);  
    }

    function addUpload () 
    {
        $('#formUpload').removeClass('d-none'); 
        $('#publish').addClass('d-none');
        // Добавляем атрибут, связанный с валидацией
        $('.custom-file-input, .label-file').attr('data-validate', true);

        fileInputClone = $('.main-card').clone(); 
    }

    function cancelUpload ()
    { 
        countFiles = 1;
        
        // Удаляем все div кроме первого
        $('.next-card').remove();

        // Чистим первый div
        $('.custom-file-input').each( function() 
        {
            $(this).val('');
            
        });

        $('.custom-file-label').each( function() 
        {
            $(this).text('');
        });
        
        $('.label-file').each( function() 
        {
            $(this).val('');
        });
        
        // Удаляем атрибут, связанный с валидацией !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $('.custom-file-input, .label-file').removeAttr('data-validate', true);
        // Удаляем связь статьи с файлами 
        $('[name="download_id"]').val('');
        // Скрываем форму для загрузки файлов
        $('#formUpload').addClass('d-none');
        // Отображаем submit на форме создания статьи
         $('#publish').removeClass('d-none');

    }

    // Отображаем короткое название файла в div относящимся к input
    function changeLabelName ()
    { 
        
        var input = $(this);
        var divCustomFile = input.parent();
        
        divCustomFile.find('.custom-file-label').each( function() 
        {
            $(this).text(input.val().split( '\\' ).pop() );
        });      
    }

    function addFileInput()
    {   

        ++countFiles;
        var localFileInput = fileInputClone.clone();
        localFileInput.removeClass('main-card').addClass('next-card card-file-'+countFiles);
        
        var newName = $(localFileInput).find('.custom-file-input, .label-file');
        newName.each(function() 
        {
            var name = $(this).attr('name');
            name = name.replace('1', countFiles);
            $(this).attr('name', name);
        });
        
        var removeButton = $(localFileInput).find('[data-file="1"]');
        removeButton.attr('data-file', countFiles).removeClass('d-none');

        localFileInput.insertBefore( $('#addMoreFilesDiv') );
    }
    
    function removeFileInput() 
    {
        $('.card-file-'+$(this).data('file') ).remove();
    }
    
    function submitFile ()
    {
        
        var formUpload = new FormData();
        
        var files = $('#formUpload').find('.custom-file-input');
        
        files.each(function() 
        {
            formUpload.append(this.name, this.files[0]);
            //console.log(formUpload.getAll(this.name));
        });
        
        var fileNames = $('#formUpload').find('.label-file');
        
        fileNames.each(function() 
        {
            formUpload.append(this.name, $(this).val());
        });
        
        axios.post('../download', formUpload, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
        })
            .then(function (response) {
                // Записываем id добавленных файлов для привязки их к статье
                $('[name="download_id"]').val(response.data);
                alert('Files added successfully');
                // Отправляем статью на сервер
                $('#createForm').trigger('submit');     
            })  
           
            .catch (error=> {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors
                }
            });
    }
    
    function validateArticle ()
    {
        $('.span-error').remove();
        
        var errors ='';
        
        var inputs = $('[data-validate="true"]');
        
        inputs.each(function() 
        {
            if ($(this).val().trim() === '')
            {
                errors += 'error';
                $(this).parent().append('<span class = "text-danger span-error">Not empty</span>');
            }
        });
        
        if(errors.indexOf('error') === -1)
        {
            submitFile();
        }
        
    }

//    return{
//        bind: bind
//    }
//
//})();

bind();

    
    
    
