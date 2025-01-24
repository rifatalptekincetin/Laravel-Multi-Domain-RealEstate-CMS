document.addEventListener('DOMContentLoaded', function() {
    init_compare_wishlist()
});
document.addEventListener('DOMContentLoaded', function() {
    init_compare_wishlist()
    let wishlist = localStorage.getItem('wishlist');
    if(wishlist){
        wishlist = JSON.parse(wishlist);
        wishlist.forEach(slug => {
            $(`.add_wishlist[data-slug="${slug}"]`).addClass('wishlist-added');
        });
    }
    $('body').on('click', '.add_wishlist', function(e){
        let slug = $(this).data('slug');
        let wishlist = localStorage.getItem('wishlist');
        if(wishlist){
            wishlist = JSON.parse(wishlist);
            if(wishlist.includes(slug)){
                wishlist = wishlist.filter(item => item !== slug);
            }else{
                wishlist.push(slug);
            }
        }else{
            wishlist = [slug];
        }
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        $(this).toggleClass('wishlist-added');
        init_compare_wishlist()
    });

    $('body').on('click', '.clear_wishlist', function(e){
        localStorage.setItem('wishlist', '[]');
        init_compare_wishlist();
    });

});

document.addEventListener('DOMContentLoaded', function() {
    let compare = localStorage.getItem('compare');
    if(compare){
        compare = JSON.parse(compare);
        compare.forEach(slug => {
            $(`.add_compare[data-slug="${slug}"]`).addClass('compare-added');
        });
    }
    $('body').on('click', '.add_compare', function(e){
        let slug = $(this).data('slug');
        let compare = localStorage.getItem('compare');
        if(compare){
            compare = JSON.parse(compare);
            if(compare.includes(slug)){
                compare = compare.filter(item => item !== slug);
            }else{
                compare.push(slug);
            }
        }else{
            compare = [slug];
        }
        localStorage.setItem('compare', JSON.stringify(compare));
        $(this).toggleClass('compare-added');
        init_compare_wishlist()
    });
});

function init_compare_wishlist(){
    let wishlist = localStorage.getItem('wishlist');
    if(!wishlist){
        wishlist = '[]';
    }
    let compare = localStorage.getItem('compare');
    if(!compare){
        compare = '[]';
    }
    if(1){
        wishlist = JSON.parse(wishlist);
        compare = JSON.parse(compare);
        $('#wishlist_count').html(wishlist.length);
        $('#compare_count').html(compare.length)
        $('.cart-btn_counter').html(wishlist.length + compare.length);
        let slugs = wishlist.concat(compare);
        slugs = slugs.filter((item, index) => slugs.indexOf(item) === index);
        slugs = slugs.toString();

        $.ajax({
            url : window.short_data_route,
            type : 'GET',
            data : {
                'slugs' : slugs
            },
            success : function(data) {  
                $('.wishlist-holder').html('');
                $('.compare-holder').html('');
                wishlist.forEach(slug => {
                    let item = data[slug];
                    if(item){
                        $('.wishlist-holder').append(`
                            <li>
                                <div class="widget-posts-img"><a href="${item.url}"><img
                                                src="${item.image}"></a>
                                    </div>
                                    <div class="widget-posts-descr">
                                        <h4><a href="${item.url}">${item.title}</a></h4>
                                        <div class="geodir-category-location fl-wrap"><a href="#"><i
                                                    class="fas fa-map-marker-alt"></i> ${item.district}, ${item.city}, ${item.state}
                                            </a></div>
                                        <div class="widget-posts-descr-price"><span>${item.categories.toString()}</div>
                                        <div class="widget-posts-descr-price"><span>Fiyat: </span> ${item.price}</div>
                                        <div class="clear-wishlist" data-slug="${item.slug}"><i class="fal fa-trash-alt"></i></div>
                                    </div>
                            </li>
                        `);
                    }
                });
                compare.forEach(slug => {
                    let item = data[slug];
                    if(item){
                        $('.compare-holder').append(`
                            <li>
                                <div class="widget-posts-img"><a href="${item.url}"><img
                                                src="${item.image}"></a>
                                    </div>
                                    <div class="widget-posts-descr">
                                        <h4><a href="${item.url}">${item.title}</a></h4>
                                        <div class="geodir-category-location fl-wrap"><a href="#"><i
                                                    class="fas fa-map-marker-alt"></i> ${item.district}, ${item.city}, ${item.state}
                                            </a></div>
                                        <div class="widget-posts-descr-price"><span>${item.categories.toString()}</div>
                                        <div class="widget-posts-descr-price"><span>Fiyat: </span> ${item.price}</div>
                                        <div class="clear-wishlist" data-slug="${item.slug}"><i class="fal fa-trash-alt"></i></div>
                                    </div>
                            </li>
                        `);
                    }
                });
            },
            error : function(request,error)
            {
                console.log("error fetching wishlist");
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    $(document).on('input','.search-suggest', function(e){
        let value = $(this).val();
        if(value.length > 2){
            $.ajax({
                url : window.suggest_route,
                type : 'GET',
                data : {
                    'q' : value
                },
                success : function(data) {  
                    $('.search-suggest-results').html('');
                    data.listings.forEach(listing => {
                        $('.search-suggest-results').append(`
                            <li><a href="${listing.url}"><span>İlan:</span> ${listing.title}</a></li>
                        `);
                    });
                    data.categories.forEach(category => {
                        $('.search-suggest-results').append(`
                            <li><a href="${category.url}"><span>Kategori:</span> ${category.title}</a></li>
                        `);
                    });
                    data.states.forEach(state => {
                        $('.search-suggest-results').append(`
                            <li><a href="${state.url}"><span>İl:</span> ${state.title}</a></li>
                        `);
                    });
                    data.cities.forEach(city => {
                        $('.search-suggest-results').append(`
                            <li><a href="${city.url}"><span>İlçe:</span> ${city.title}</a></li>
                        `);
                    });
                    data.districts.forEach(district => {
                        $('.search-suggest-results').append(`
                            <li><a href="${district.url}"><span>Mahalle:</span> ${district.title}</a></li>
                        `);
                    });
                },
                error : function(request,error)
                {
                    console.log("error fetching search results");
                }
            });
        } else{
            $('.search-suggest-results').html('');
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    $(document).on("click",".ajax-submit .form-message",function(){
        $(this).hide();
    });

    $(document).on('submit','.ajax-submit',function(e){
        e.preventDefault();
        var form = $(this);
        $(this).css("position","relative");
        $.ajax({
            type: "POST",
            url: window.form_submit_route,
            data: form.serialize(),
            success: function(data)
            {
                $(form).prepend('<div class="form-message success"><i class="fal fa-times"></i><div class="content"><i class="fal fa-check-circle"></i><h4 class="message"></h4></div></div>');
                $(form).find('.form-message .message').text(data.message);
                setTimeout(function(){
                    $(form).find('.form-message').fadeOut();
                },5000);
                $(form).find('input[type="text"],input[type="email"],input[type="tel"],input[type="number"],textarea,select').val('');

            },
            error: function (request, status, error) {
                alert(request.responseJSON.message);
            }
        });
        
    });
});

document.addEventListener('DOMContentLoaded', function() {
    $(document).on('change', '.change-submit[name="state"]',function() {
        $('.change-submit[name="city"]').val("")
        $('.change-submit[name="district"]').val("")
    });
    $(document).on('change', '.change-submit[name="city"]',function() {
        $('.change-submit[name="district"]').val("")
    });
    $(document).on('change', '.change-submit',function() {
        $(this).closest('form').submit();
    });
});