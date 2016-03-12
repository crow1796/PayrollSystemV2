(function(window, document, $){
    //Image URL Reader
    var ReadImageURL = function(inputFile, outputElement){
        var inputFile = inputFile,
            outputElement = outputElement,
            readImg = null,
            result = '';
        return {
            init: function(fileReader){
                if(fileReader == null){
                    readImg = new FileReader();
                }else{
                    readImg = fileReader;
                }
                return this;
            },
            readImgData: function(){
                if(inputFile.files.length > 0){
                    readImg.readAsDataURL(inputFile.files[0]);
                }
                return this;
            },
            getResult: function(){
                readImg.onload = function(e){
                    outputElement.attr('src', e.target.result);
                };
            }
        };
    }

    $(function(){

        /**
         * Initialize JQuery UI Datepicker and Timepicker add-on
         */
        $('.input-date').datepicker();
        $('.input-time').timepicker();

        /**
         * Initialize DataTables
         */
        var defaultDtAttributesWithLength = function(displayLength){
            return {
                'info': false,
                'length': false,
                'responsive': true,
                'bLengthChange': false,
                'iDisplayLength': displayLength,
                'oLanguage': {
                    'oPaginate': {
                        'sNext': '&raquo;',
                        'sPrevious': '&laquo;'
                    }
                }
            };
        };

        $('.bmpc-table-container table')
            .DataTable(defaultDtAttributesWithLength(14));

        $('.events-table-container table')
            .DataTable(defaultDtAttributesWithLength(5));

        $('.events-calendar-container .events-calendar')
            .fullCalendar({
                editable: false,
                // eventLimit: true,
                weekends: true,
                header: {
                    left: 'prev today',
                    center: 'title',
                    right: 'today next'
                },
                eventSources: [window.location.origin + '/api/events'],
                eventRender: function(event, element) {
                    var location = event.location ? event.location : 'N/A';
                    element.popover({
                        html: true,
                        title: '<b>' + event.title + '</b>',
                        placement: 'top',
                        content:'<b>Event ID</b>: <span class="event-id">' + event.id + '</span>'
                                + '<br><b>Start</b>: ' 
                                + moment(moment(event.start).toDate()).format('MMMM DD, YYYY')
                                + '<br><b>Location</b>: ' + location
                                + '<hr>' + event.description
                                + '<hr><a href="' + (window.location.pathname + '/' 
                                + event.id + '/edit') 
                                + '"><span class="fa fa-edit"></span> Edit</a> | '
                                + '<a type="submit" data-toggle="modal"'
                                + ' class="btn-link btn-md delete-event-confirmation-modal-button"'
                                + ' href="#delete-confirmation-modal"><span class="fa fa-trash">'
                                + '</span> Delete</a>'
                    });
                },
                eventAfterRender: function(event, element){
                    element.on('click', function(){
                        var deleteBtn = $(this).next()
                                                .children('.popover-content')
                                                .children('.delete-event-confirmation-modal-button');

                        deleteBtn.unbind('click');

                        deleteBtn.on('click', function(){
                            var eventId = $(this).parent()
                                                .children('.event-id')
                                                .text();
                            var modal = $($(this).attr('href'));
                            var formAction = window.location.href + '/' + eventId;
                            modal.children()
                                .find('form')
                                .attr('action', formAction);
                        });
                    });
                }
            });

        $('.delete-employee-confirmation-modal-button')
            .on('click', function(){
                var employeeId = $(this).parent().parent().parent().prev().text();
                modifyDeleteModalFormAction($(this), employeeId);
            });

        $('.delete-user-confirmation-modal-button')
            .on('click', function(){
                var userId = $(this).parent().parent().parent().prev().text();
                modifyDeleteModalFormAction($(this), userId);
            });

        $('.delete-log-confirmation-modal-button')
            .on('click', function(){
                var logId = $(this).parent().parent().parent().prev().text();
                modifyDeleteModalFormAction($(this), logId);
            });

        function modifyDeleteModalFormAction(target, id){
            var modal = $(target.attr('href'));
            var formAction = window.location.href;
            // window.location.origin
            // window.location.pathname
            modal.children()
                    .find('form')
                    .attr('action', formAction + "/" + id);
        }

        $('.positive-only')
            .on('keyup', function(){
                if($(this).val() < 0){
                    $(this).val(0);
                }
            });

        /**
         * Sidebar menu transitions
         */
        $('.sidebar-menu-toggle, #page-overlay').on('click', function(e){
            e.preventDefault();
            $('.sidebar-submenu').removeClass('sidebar-submenu-active')
            $('#sidebar-menu-container ul li a').removeClass('active');

            $('.sidebar-menu-toggle').toggleClass('sidebar-menu-toggle-active');
            $('#page-overlay').toggleClass('page-overlay-active');
            $($('.sidebar-menu-toggle').attr('href')).toggleClass('sidebar-menu-container-active');
        });

        /**
         * Sidebar submenu transitions
         */
        $('.sidebar-submenu-toggle').on('click', function(e){
            e.preventDefault();
            $('.sidebar-submenu').removeClass('sidebar-submenu-active');
            $(this).next().toggleClass('sidebar-submenu-active');
        });

        $('#sidebar-menu-container ul li a').on('click', function(){
            // $('#sidebar-menu-container ul li a').removeClass('active');
            // $(this).addClass('active');
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                return true;
            }
            $(this).addClass('active');
        });

        $('.panel .panel-heading').on('click', function(){
            var panel_body = $(this).next();
            if(panel_body.hasClass('panel-body-active')){
                panel_body.removeClass('panel-body-active');
                $(this).children()
                    .find('.fa')
                    .removeClass('fa-caret-up')
                    .addClass('fa-caret-down');
            }else{
                panel_body.addClass('panel-body-active');
                $(this).children()
                    .find('.fa')
                    .removeClass('fa-caret-down')
                    .addClass('fa-caret-up');
            }
        });

        /**
         * Request error message transition
         */
        $('.alert-close-button')
            .on('click', function(){
                $('.request-error-container')
                    .slideUp('fast');
            });

        $('#civil_status')
            .on('change', function(){
                if($(this).val().toLowerCase() != 'single'.toLowerCase()){
                    $('.not-single-additional-info-container')
                        .slideDown('fast');
                    return true;
                }
                $('.not-single-additional-info-container')
                    .children()
                    .find('input')
                    .each(function(){
                        $(this).val('');
                    });
                $('.not-single-additional-info-container')
                    .slideUp('fast');
            });

        $(window)
            .on('scroll', function(){
                if($(this).scrollTop() > 50){
                    $('#back-to-top-button')
                        .slideDown('fast');

                    return true;
                }

                $('#back-to-top-button')
                    .slideUp('fast');
            });

        $('#back-to-top-button')
            .on('click', function(){
                $('html, body')
                    .animate({scrollTop: 0}, 1000, 'easeOutCirc');
            });

        /**
         * Event All Day Checkbox
         * @param  {element} element 
         * @return {mixed}         
         */
        function checkEventCheckbox(element){
            if(element == null){
                return false;
            }
            var timeInputs = [
                $('#event_start_time'),
                $('#event_end_time'),
            ];
            if(element.checked){
                $.each(timeInputs, function(){
                    $(this).parent()
                            .parent()
                            .slideUp('fast');
                    $(this).val('00:00');
                });
                return true;
            }
            $.each(timeInputs, function(){
                $(this).parent()
                        .parent()
                        .slideDown('fast');
                $(this).val('00:00');
            });
        }

        // Check all day checkbox on load
        checkEventCheckbox($('[type="checkbox"][name="all_day"]')[0]);

        $('[type="checkbox"][name="all_day"]')
            .on('change', function(){
                checkEventCheckbox($(this).context);
            });
        // Event All Day Checkbox
        
        $('#display-photo-thumbnail')
            .on('click', function(e){
                $('#image-input').click();
            });

        $('#image-input')
            .on('change', function(e){
                var source = document.getElementById('image-input');
                var output = $('#display-photo-thumbnail');
                var reader = new ReadImageURL(source, output)
                                    .init()
                                    .readImgData()
                                    .getResult();
            });

        $('.sidebar-area-list-nav-up, .sidebar-area-event-nav-up')
            .on('click', function(){
                var height = $(this).next().outerHeight();
                $(this).next()
                        .animate({
                            scrollTop: '-=' + height + 'px'
                        }, 500);
            });

        $('.sidebar-area-list-nav-down, .sidebar-area-event-nav-down')
            .on('click', function(){
                var height = $(this).prev().outerHeight();
                $(this).prev()
                        .animate({
                            scrollTop: '+=' + height + 'px'
                        }, 500);
            });

        $('.username-control')
            .on('focusout', function(){
                var suggestionsContainer = $(this).next();
                // suggestionsContainer.hide('fast');
            })
            .on('keyup focusin', function(){
                var suggestionsContainer = $(this).next();
                var suggestions = '';
                var target = $(this);
                var url = window.location.origin + '/api/match-employees';
                var token = $(this).parent()
                                    .parent().parent()
                                    .parent().parent()
                                    .parent().parent()
                                    .find('[name="_token"]').val();
                var username = $(this).val();
                var requestData = {
                    '_token' : token,
                    'username' : username
                };

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: requestData,
                    beforeSend: function(data){
                    },
                    success: function(data){
                        var containerStart = '<div title="Close suggestions" '
                                            + 'class="text-center username-suggesions-close">'
                                            + '<span class="fa fa-close"></span></div>'
                                            + '<ul class="nav nav-pills nav-stacked username-suggestions">';
                        var results = '';
                        var containerEnd = '</ul>';
                        var suffix = '';
                        results += ('<li class="username-suggestion">'
                                    + '<a class="text-center username-suggestion-clear"><span class="fa fa-eraser"></span> Clear </a>'
                                    + '</li>');
                        for(var i = 0; i < data.length; i++){
                            suffix = data[i].suffix ? data[i].suffix : '';
                            results += ('<li class="username-suggestion">'
                                        + '<a data-employee_id="' + data[i].id + '">'
                                        + data[i].id 
                                        + '<span class="pull-right">'
                                        + data[i].first_name + ' ' + data[i].middle_name
                                        + ' ' + data[i].last_name + ' ' + suffix
                                        + '</span></a>'
                                        + '</li>');
                        }
                        containerStart += (results + containerEnd);
                        suggestions = containerStart;
                    },
                    complete: function(data){
                        if(data.responseJSON.length <= 0){
                            target.addClass('no-result-control');
                            suggestionsContainer.show('fast');
                            suggestionsContainer.html('<p class="text-center">No data matched.</p>');
                            return false;
                        }
                        target.removeClass('no-result-control')
                        suggestionsContainer.html(suggestions);
                        suggestionsContainer.show('fast', function(){
                            rebindUsernameSuggestionEvents('click');
                        });
                        return true;
                    }
                });
            });
            function rebindUsernameSuggestionEvents(){
                $('.username-suggestions-container .username-suggestions .username-suggestion a, .username-suggesions-close, .username-suggestion-clear')
                    .unbind();
                $('.username-suggestions-container .username-suggestions .username-suggestion')
                    .on('click', 'a', function(e){
                        e.preventDefault();
                        var suggestionsContainer = $(this).parent().parent().parent();
                        suggestionsContainer.prev().val($(this).data('employee_id'));
                        suggestionsContainer.hide('fast');
                    });
                $('.username-suggestions-container')
                    .on('click', '.username-suggesions-close', function(){
                        suggestionsContainer = $(this).parent();
                        suggestionsContainer.hide('fast');
                    });
                $('.username-suggestions-container')
                    .on('click', '.username-suggestion-clear', function(){
                        var suggestionsContainer = $(this).parent().parent().parent();
                        suggestionsContainer.prev().val('');
                        suggestionsContainer.hide('fast');
                    })
            }

        $('.start-payroll-transact-button')
            .on('click', function(e){
                e.preventDefault();
                $('.dtr-transaction-container .dtr-transaction')
                    .removeClass('panel-body-active')
                    .addClass('panel-body-active');

                var employeeId = $(this).data('employee_id');
                var fullname = $(this).data('fullname');
                var position = $(this).data('position');
                var department = $(this).data('department');

                $('.transact-employee-information').hide('fast', function(){
                    $('#transact-employee-id').text(employeeId);
                    $('#transact-fullname').text(fullname);
                    $('#transact-position').text(position);
                    $('#transact-department').text(department);
                    $('.transact-employee-information').show('fast');
                });

                $('[name="time_in"],[name="time_out"]').val('');

                $('#regular-hours').text('0');
                $('#undertime-hours').text('0');
                $('#overtime-hours').text('0');
                $('#total-hours').text('0');
            });

        $('[name="time_in"], [name="time_out"]')
            .on('keyup blur', function(e){
                var regularHours = 0;
                var undertimeHours = 0;
                var overtimeHours = 0;
                var totalHours = 0;
                var timeIn = 0;
                var timeOut = 0;
                var calculatedHours = 0;

                timeIn = parseInt(($('[name="time_in"]').val() != '') ? $('[name="time_in"]').val() : 0);
                timeOut = parseInt(($('[name="time_out"]').val() != '') ? $('[name="time_out"]').val() : 0);
                calculatedHours = (timeIn > timeOut) ? ((timeOut + 2400) - timeIn) : (timeOut - timeIn);

                regularHours = calculatedHours;
                if(calculatedHours >= 800){
                    regularHours = 800;
                }

                if(regularHours < 800){
                    undertimeHours = 800 - regularHours;
                }

                if(calculatedHours > 900){
                    overtimeHours = (calculatedHours - regularHours) - 100;
                }

                totalHours = (regularHours + overtimeHours);

                regularHours /= 100;
                undertimeHours /= 100;
                overtimeHours /= 100;
                totalHours /= 100;

                $('#regular-hours').text((regularHours < 8)? 0 : regularHours);
                $('#undertime-hours').text(undertimeHours);
                $('#overtime-hours').text(overtimeHours);
                $('#total-hours').text(totalHours);
            });

        $('.dtr-transaction-container .dtr-transaction form')
            .off('submit')
            .on('submit', function(e){
                e.preventDefault();
                if(e.handled !== true){
                    e.handled = true;
                    var baseUrl = window.location.origin;
                    var requestData = {
                        'time_in': $(this).children().find('[name="time_in"]').val(),
                        'time_out': $(this).children().find('[name="time_out"]').val(),
                        '_token': $(this).children('[name="_token"]').val()
                    };
                    $.ajax({
                        url: baseUrl + '/api/add-employee-dtr',
                        type: 'POST',
                        data: requestData,
                        success: function(response){
                            var message = '';
                            if(response.errors === true){
                                delete response.errors;
                                $.each(response, function(key, value){
                                    $.each(value, function(key2, value2){
                                        message += ('<p class="text-center">' + value2 + '</p>');
                                    });
                                });

                                toggleModalMessageContainerWithMessage(message, 'modal-message-container-danger');
                                return false;
                            }

                            message = ('<p class="text-center">' + response + '</p>');
                            toggleModalMessageContainerWithMessage(message, 'modal-message-container-success');
                        }
                    });
                }
                return false;
            });

        $('.multiple-file-input-container input')
            .on('change', function(e){
                var fileCount = $(this).context.files.length;
                if(fileCount > 0){
                    $(this).next()
                            .children('.file-count')
                            .text(fileCount + ' files selected');
                }
            });

        function toggleModalMessageContainerWithMessage(message, subclass){
            $('.modal-message-container .modal-message')
                .html(message)
                .parent()
                .removeClass()
                .addClass('modal-message-container')
                .addClass(subclass)
                .slideDown('fast', function(e){
                    var container = $(this);
                    window.setTimeout(function(){
                        container.hide('fast');
                    }, 3000);
                });
        }
    });
}(window, document, window.jQuery));