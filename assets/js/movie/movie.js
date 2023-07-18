'use strict';

import routes from '../../../public/js/fos_js_routes.json';
import Routing from '../../../public/bundles/fosjsrouting/js/router.min.js';

$(function () {
    //set the routes for the Routing object
    Routing.setRoutingData(routes);

    /*++++++++++++ start detail ++++++++++++++*/
    $(document).on("click", '.show-modal-detail', function (event) {
        getDetail(event, this);
    })

    function getDetail(event, selector) {
        event.preventDefault();
        let idMovie = $(selector).data('movie');
        $.ajax({
            type: 'get',
            url: Routing.generate('app_ajax_detail_movie', {id: idMovie}),
            success: function (data) {
                if (data.isValid) {
                    $("#showDetail-content").html(data.content);
                    $("#showDetail").modal('show');
                    console.log(data);
                } else {
                    console.log('something went wrong');
                }
            }
        });
    }

    /*------------- end detail ---------------*/
    /*++++++++ start movies_by_genres ++++++++*/
    $("input[id^='genre_']").on("click", function (event) {
        let genresIds = [];
        $("input[id^='genre_']:checked").each(function () {
            genresIds.push(this.value);
        });

        $.ajax({
            type: 'post',
            url: Routing.generate('app_ajax_movies_by_genres'),
            data: {genresIds: genresIds},
            success: function (data) {
                if (data.isValid) {
                    $("#list_movies").html(data.content);
                } else {
                    console.log('something went wrong');
                }
            }
        });
    })
    /*--------- end movies_by_genres ---------*/

    /*++++++++++++ start search ++++++++++++++*/
    function search(val, previousVal) {
        if (val.length >= 2 && val !== previousVal) {
            $.ajax({
                type: 'post',
                url: Routing.generate('app_ajax_search_movies'),
                data: {title: val},
                success: function (data) {
                    if (data.isValid) {
                        $("#list_search").removeClass('d-none');
                        $("#list_search").addClass('d-block');
                        $("#list_search").html(data.content);
                    } else {
                        console.log('something went wrong');
                    }
                }
            });
        }
    }

    let previousVal = null;
    $("#search").keyup($.debounce(function (event) {
        let val = $(this).val().trim();
        search(val, previousVal);
        previousVal = val;
    }, 300))

    $(document).on("click", function (event) {
        $("#search").val(null);
        $("#list_search").html(null);
        $("#list_search").addClass('d-none');
        $("#list_search").removeClass('d-block');
    })

    $('#autocomplete-container').click(function (event) {
        event.stopPropagation();
    });
    /*------------- end search ---------------*/
})