// input context
function addInputContext() {
    let id = getID()
    $('#div-input-context').append(
            '<div id="dic-' + id + '" class="input-group m-b-5">' +
            '   <input type="text" name="inputContext[]" class="form-control form-control-sm" value="" placeholder="ระบุตัวแปลนำเข้า">' +
            '   <div class="input-group-append">' +
            '       <button class="btn btn-danger btn-sm" type="button" onclick="$(\'#dic-' + id + '\').remove()"><i class="fa fa-trash"></i></button>' +
            '   </div>' +
            '</div>'
            )
}

// output context
function addOutputContext() {
    let id = getID()
    $('#div-output-context').append(
            '<div id="doc-' + id + '" class="input-group m-b-5">' +
            '   <input type="text" name="outputContext[]" class="form-control form-control-sm" value="" placeholder="ระบุตัวแปลส่งออก">' +
            '   <div class="input-group-append">' +
            '       <button class="btn btn-danger btn-sm" type="button" onclick="$(\'#doc-' + id + '\').remove()"><i class="fa fa-trash"></i></button>' +
            '   </div>' +
            '</div>'
            )
}

// training phrases
function addTrainingPhrase() {
    let id = getID()
    $('#div-training-phrase').append(
            '<div id="dtp-' + id + '" class="input-group m-b-5">' +
            '   <input type="text" name="trainingPhrase[' + id + ']" class="form-control form-control-sm" value="" placeholder="ระบุกลุ่มคำถาม">' +
            '   <div class="input-group-append">' +
            '       <button class="btn btn-danger btn-sm" type="button" onclick="$(\'#dtp-' + id + '\').remove()"><i class="fa fa-trash"></i></button>' +
            '   </div>' +
            '</div>'
            )
}

// parameter
function addParameterModal() {
    $('#parameter-form').parsley().reset()
    $('#input-parameter-id').val(getID())
    $('#input-parameter-name').val('')
    $('#input-parameter-entity').val('@sys.any')
    $('#input-parameter-prompt').val('')
    $('#fa-parameter-form').removeClass('fa-spinner fa-spin').addClass('fa-save')
    $('#btn-parameter-form').prop('disabled', false)
    $('#parameter-modal').modal('show', {backdrop: 'true'})
}

function editParameterModal(id) {
    $('#input-parameter-id').val($('input[name*="parameterID[' + id + ']"]').val())
    $('#input-parameter-name').val($('input[name*="parameterName[' + id + ']"]').val())
    $('#input-parameter-entity').val($('input[name*="parameterEntity[' + id + ']"]').val())
    $('#input-parameter-prompt').val($('input[name*="parameterPrompt[' + id + ']"]').val())
    $('#parameter-form').parsley().reset()
    $('#fa-parameter-form').removeClass('fa-spinner fa-spin').addClass('fa-save')
    $('#btn-parameter-form').prop('disabled', false)
    $('#parameter-modal').modal('show', {backdrop: 'true'})
}

function deleteParameter(id) {
    $('#ktr-' + id).remove()
    setTimeout(function () {
        if ($('.ktr-check').length) {
            $('#div-parameter-empty').hide()
        } else {
            $('#div-parameter-empty').show()
        }
    }, 200)
}

function processParameter() {
    if ($('#parameter-form').parsley().validate()) {
        $('#fa-parameter-form').removeClass('fa-save').addClass('fa-spinner fa-spin')
        $('#btn-parameter-form').prop('disabled', true)
        let id = $('#input-parameter-id').val()
        let name = $('#input-parameter-name').val()
        let entity = $('#input-parameter-entity').val()
        let prompt = $('#input-parameter-prompt').val()
        if ($('#ktr-' + id).length) {
            $('#ktr-' + id).html(
                    '   <td>' + name + '</td>' +
                    '   <td>' + entity + '</td>' +
                    '   <td>' + prompt + '</td>' +
                    '   <td class="text-nowrap">' +
                    '       <a href="javascript:void(0)" class="btn btn-xs btn-outline-info m-r-1" onclick="editParameterModal(\'' + id + '\')"><i class="fa fa-edit"></i></a>' +
                    '       <a href="javascript:void(0)" class="btn btn-xs btn-outline-danger" onclick="deleteParameter(\'' + id + '\')"><i class="fa fa-close"></i></a>' +
                    '       <input type="hidden" name="parameterID[' + id + ']" value="' + id + '">' +
                    '       <input type="hidden" name="parameterName[' + id + ']" value="' + name + '">' +
                    '       <input type="hidden" name="parameterEntity[' + id + ']" value="' + entity + '">' +
                    '       <input type="hidden" name="parameterPrompt[' + id + ']" value="' + prompt + '">' +
                    '   </td>'
                    )
        } else {
            $('#div-parameter').append(
                    '<tr id="ktr-' + id + '" class="ktr-check">' +
                    '   <td>' + name + '</td>' +
                    '   <td>' + entity + '</td>' +
                    '   <td>' + prompt + '</td>' +
                    '   <td class="text-nowrap">' +
                    '       <a href="javascript:void(0)" class="btn btn-xs btn-outline-info m-r-1" onclick="editParameterModal(\'' + id + '\')"><i class="fa fa-edit"></i></a>' +
                    '       <a href="javascript:void(0)" class="btn btn-xs btn-outline-danger" onclick="deleteParameter(\'' + id + '\')"><i class="fa fa-close"></i></a>' +
                    '       <input type="hidden" name="parameterID[' + id + ']" value="' + id + '">' +
                    '       <input type="hidden" name="parameterName[' + id + ']" value="' + name + '">' +
                    '       <input type="hidden" name="parameterEntity[' + id + ']" value="' + entity + '">' +
                    '       <input type="hidden" name="parameterPrompt[' + id + ']" value="' + prompt + '">' +
                    '   </td>' +
                    '</tr>'
                    )
        }
        setTimeout(function () {
            if ($('.ktr-check').length) {
                $('#div-parameter-empty').hide()
            } else {
                $('#div-parameter-empty').show()
            }
            $('#parameter-modal').modal('hide')
        }, 200)
    }
}

// response
function addResponseModal() {
    if ($('#drqr-0').length == 0) {
        $('#show-quick-replie').show()
    } else {
        $('#show-quick-replie').hide()
    }
    $('#response-modal').modal('show', {backdrop: 'true'})
}

// response text
function addResponseText() {
    let id = getID()
    $('#div-response').append(
            '<div id="drt-' + id + '" class="col-md-3">' +
            '   <div class="card card-box">' +
            '       <div class="card-body p-2">' +
            '           <div class="d-flex no-block">' +
            '               <h4 class="card-title">ข้อความ</h4>' +
            '               <div class="ml-auto">' +
            '                   <i class="fa fa-trash cursor-pointer" onclick="$(\'#drt-' + id + '\').remove()"></i>' +
            '               </div>' +
            '           </div>' +
            '           <div id="drt-f-' + id + '" class="form-group">' +
            '           </div>' +
            '           <div class="dot-box" onclick="addResponseTextInput(\'drt-f-' + id + '\')">' +
            '               <div class="dot-box-message">' +
            '                   <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มข้อความ</span>' +
            '               </div>' +
            '           </div>' +
            '       </div>' +
            '   </div>' +
            '</div>'
            )
    $('#response-modal').modal('hide')
}

function addResponseTextInput(for_id) {
    let id = getID()
    $('#' + for_id).append(
            '<div id="drt-i-' + id + '" class="input-group m-b-5">' +
            '   <input type="text" name="responseText[' + for_id + '][]" class="form-control form-control-sm" value="" placeholder="ระบุข้อความ">' +
            '   <div class="input-group-append">' +
            '       <button class="btn btn-danger btn-sm" type="button" onclick="$(\'#drt-i-' + id + '\').remove()"><i class="fa fa-trash"></i></button>' +
            '   </div>' +
            '</div>'
            )
}

// response image
function addResponseImage() {
    let id = getID()
    $('#div-response').append(
            '<div id="dri-' + id + '" class="col-md-3">' +
            '   <div class="card card-box">' +
            '       <div class="card-body p-2">' +
            '           <div class="d-flex no-block">' +
            '               <h4 class="card-title">รูปภาพ</h4>' +
            '               <div class="ml-auto"><i class="fa fa-trash cursor-pointer" onclick="$(\'#dri-' + id + '\').remove()"></i></div>' +
            '           </div>' +
            '           <div class="intent-image-div">' +
            '               <img class="img-responsive" id="pri-' + id + '" src="' + service_base_url + 'assets/img/default.jpg" onerror="this.src=\'' + service_base_url + 'assets/img/default.jpg\'">' +
            '           </div>' +
            '           <div class="m-t-5">' +
            '               <div class="input-group">' +
            '                   <input type="text" id="iri-' + id + '" name="responseImage[]" class="form-control form-control-sm" value="" placeholder="ระบุที่อยู่ หรืออัพโหลดรูปภาพ" onchange="previewImage(\'pri-' + id + '\', this.value)">' +
            '                   <div class="input-group-append">' +
            '                       <button class="btn btn-info btn-sm" type="button" onclick="uploadImageModal(\'iri-' + id + '\')"><i class="fa fa-upload"></i></button>' +
            '                   </div>' +
            '               </div>' +
            '           </div>' +
            '       </div>' +
            '   </div>' +
            '</div>'
            )
    $('#response-modal').modal('hide')
}

// response card
function addResponseCard() {
    let id = getID()
    $('#div-response').append(
            '<div id="drc-' + id + '" class="col-md-3">' +
            '   <div class="card card-box">' +
            '       <div class="card-body p-2">' +
            '           <div class="d-flex no-block">' +
            '               <h4 class="card-title">การ์ด</h4>' +
            '               <div class="ml-auto"><i class="fa fa-trash cursor-pointer" onclick="$(\'#drc-' + id + '\').remove()"></i></div>' +
            '           </div>' +
            '           <div class="intent-image-div">' +
            '               <img class="img-responsive" id="prc-i-' + id + '" src="' + service_base_url + 'assets/img/default.jpg" onerror="this.src=\'' + service_base_url + 'assets/img/default.jpg\'">' +
            '           </div>' +
            '           <div class="m-t-5">' +
            '               <div class="input-group m-t-3">' +
            '                   <input type="text" id="irc-i-' + id + '" name="responseCard[imageUri][' + id + ']" class="form-control form-control-sm" value="" placeholder="ระบุที่อยู่ หรืออัพโหลดรูปภาพ" onchange="previewImage(\'prc-i-' + id + '\', this.value)">' +
            '                   <div class="input-group-append">' +
            '                       <button class="btn btn-info btn-sm" type="button" onclick="uploadImageModal(\'irc-i-' + id + '\')"><i class="fa fa-upload"></i></button>' +
            '                   </div>' +
            '               </div>' +
            '               <div class="form-group m-t-3 m-b-0">' +
            '                   <input type="text" id="irc-t-' + id + '" name="responseCard[title][' + id + ']" class="form-control form-control-sm" value="" placeholder="ระบุหัวข้อ" required>' +
            '               </div>' +
            '               <div class="input-group m-t-3">' +
            '                   <input type="text" id="irc-st-' + id + '" name="responseCard[subtitle][' + id + ']" class="form-control form-control-sm" value="" placeholder="ระบุหัวข้อย่อย">' +
            '               </div>' +
            '               <div class="input-group m-t-3">ปุ่มที่ 1</div>' +
            '               <div class="input-group m-t-3">' +
            '                   <input type="text" id="irc-b1-' + id + '" name="responseCard[text][' + id + '][0]" class="form-control form-control-sm" value="" placeholder="ระบุชื่อลิงค์">' +
            '               </div>' +
            '               <div class="input-group m-t-3">' +
            '                   <input type="text" id="irc-p1-' + id + '" name="responseCard[postback][' + id + '][0]" class="form-control form-control-sm" value="" placeholder="ระบุลิงค์">' +
            '               </div>' +
            '               <div class="input-group m-t-3">ปุ่มที่ 2</div>' +
            '               <div class="input-group m-t-3">' +
            '                   <input type="text" id="irc-b2-' + id + '" name="responseCard[text][' + id + '][1]" class="form-control form-control-sm" value="" placeholder="ระบุชื่อลิงค์">' +
            '               </div>' +
            '               <div class="input-group m-t-3">' +
            '                   <input type="text" id="irc-p2-' + id + '" name="responseCard[postback][' + id + '][1]" class="form-control form-control-sm" value="" placeholder="ระบุลิงค์">' +
            '               </div>' +
            '               <div class="input-group m-t-3">ปุ่มที่ 3</div>' +
            '               <div class="input-group m-t-3">' +
            '                   <input type="text" id="irc-b3-' + id + '" name="responseCard[text][' + id + '][2]" class="form-control form-control-sm" value="" placeholder="ระบุชื่อลิงค์">' +
            '               </div>' +
            '               <div class="input-group m-t-3">' +
            '                   <input type="text" id="irc-p3-' + id + '" name="responseCard[postback][' + id + '][2]" class="form-control form-control-sm" value="" placeholder="ระบุลิงค์">' +
            '               </div>' +
            '           </div>' +
            '       </div>' +
            '   </div>' +
            '</div>'
            )
    $('#response-modal').modal('hide')
}

// response quick replie
function addResponseQuickReplie() {
    if ($('#drqr-0').length == 0) {
        $('#div-response').append(
                '<div id="drqr-0" class="col-md-3">' +
                '   <div class="card card-box">' +
                '       <div class="card-body p-2">' +
                '           <div class="d-flex no-block">' +
                '               <h4 class="card-title">ทางเลือก</h4>' +
                '               <div class="ml-auto">' +
                '                   <i class="fa fa-trash cursor-pointer" onclick="$(\'#drqr-0\').remove()"></i>' +
                '               </div>' +
                '           </div>' +
                '           <div class="input-group m-t-3">' +
                '               <input type="text" name="responseQuickReplie[title]" class="form-control form-control-sm" value="" placeholder="ระบุหัวข้อทางเลือก">' +
                '           </div>' +
                '           <div id="drqr-f-0" class="form-group">' +
                '           </div>' +
                '           <div class="dot-box" onclick="addResponseQuickReplieInput()">' +
                '               <div class="dot-box-message">' +
                '                   <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มทางเลือก</span>' +
                '               </div>' +
                '           </div>' +
                '       </div>' +
                '   </div>' +
                '</div>'
                )
    }
    $('#response-modal').modal('hide')
}

function addResponseQuickReplieInput() {
    let id = getID()
    $('#drqr-f-0').append(
            '<div id="drqr-i-' + id + '" class="input-group m-t-3">' +
            '   <input type="text" name="responseQuickReplie[quickReplies][]" class="form-control form-control-sm" value="" placeholder="ระบุทางเลือก">' +
            '   <div class="input-group-append">' +
            '       <button class="btn btn-danger btn-sm" type="button" onclick="$(\'#drqr-i-' + id + '\').remove()"><i class="fa fa-trash"></i></button>' +
            '   </div>' +
            '</div>'
            )
}

// global
function uploadImageModal(for_id) {
    $('#upload-image-form')[0].reset()
    $('#upload-image-form').parsley().reset()
    $('#for-id').val(for_id)
    $('#file_image_preview').attr('src', service_base_url + 'assets/img/default.jpg')
    $('#upload-image-modal').modal('show', {backdrop: 'true'})
}

function uploadImageProcess() {
    if ($('#upload-image-form').parsley().validate()) {
        $('#upload-image-fa').removeClass('fa-save').addClass('fa-spinner fa-spin')
        $('#upload-image-btn').prop('disabled', true)
        $.ajax({
            url: service_base_url + 'intents/uploadimageprocess',
            type: 'POST',
            data: new FormData($('#upload-image-form')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function (response) {
                setTimeout(function () {
                    $('#' + $('#for-id').val()).val(response.imageURI).change()
                    $('#upload-image-fa').removeClass('fa-spinner fa-spin').addClass('fa-save')
                    $('#upload-image-btn').prop('disabled', false)
                    notification(response.status, response.title, response.message)
                    $('#upload-image-modal').modal('hide')
                }, 200)
            }
        })
    }
}

function previewImage(for_id, value) {
    $('#' + for_id).attr('src', value)
}

function searchImage() {
    let search_image_text = $('#search-image-text').val()
    if (search_image_text != '') {
        $('#result-image').html('<div class="col-md-12"><div style="text-align:center;padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div></div>');
        $.ajax({
            url: service_base_url + 'intents/getimage',
            type: 'POST',
            dataType: 'JSON',
            data: {
                search_image_text: search_image_text
            },
            success: function (response) {
                setTimeout(function () {
                    $('#result-image').html('')
                    for (let key in response) {
                        $('#result-image').append(
                                '<div class="cursor-pointer col-md-6 m-b-10 p-l-5 p-r-5">' +
                                '   <img class="img-responsive" src="' + response[key].image_url + '" onclick="selectImage(\'' + response[key].image_url + '\')">' +
                                '</div>'
                                )
                    }
                }, 200)
            }
        })
    }
}

function selectImage(value) {
    $('#' + $('#for-id').val()).val(value).change()
    $('#upload-image-modal').modal('hide')
}

function getID() {
    return Math.random().toString(36).substr(2, 9)
}