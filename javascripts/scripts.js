
(function ($) {
    $.fn.respcarousel = function (params) {
        var def = {
            paginationClass           : 'resppagination',
            hiddenClass               : 'resphidden',
            activeClass               : 'respactive',
            onCreatePaginationBefore  : function (elem) {},
            onCreatePaginationAfter   : function (elem) {},
            onCreateElementPagination : function (elem, index) {},
            onActivate                : function (elem, index, entry) {},
            onDeactivate              : function (elem, index, entry) {},
            delay                     : 3000
        };
        params = $.extend (def, params);
        
        var container       = $(this),
            containerParent = container.parent (),
            elements        = container.children (),
            elementsLength  = elements.length,
            pagination      = [],
            interval        = null,
            currentIndex    = 0;
        
        if (elementsLength == 0) return;
        
        var goto = function (index) {
            if (index === currentIndex) return;
            var curElem = $(elements.get (currentIndex)),
                newElem = $(elements.get (index));
            curElem.addClass (params.hiddenClass);
            newElem.removeClass (params.hiddenClass);
            params.onDeactivate (pagination[currentIndex], index, curElem);
            params.onActivate (pagination[index], index, newElem);
            currentIndex = index;
        }; // goto ();
        
        var createElementPagination = function (parent, index) {
            var e = $('<span>');
            e.on ('click', function (e) {
                e.preventDefault ();
                if (interval !== null) clearInterval (interval);
                var children = parent.find ('>span');
                children.removeClass (params.activeClass);
                goto (index);
                $(children.get (index)).addClass (params.activeClass);
            });
            parent.append (e);
            pagination.push (e);
            params.onCreateElementPagination (e, index);
            return e;
        } // createElementPagination ();
        
        var createPagination = function () {
            var p = $('<span>').addClass (params.paginationClass);
            params.onCreatePaginationBefore (p);
            createElementPagination (p, 0).addClass (params.activeClass);
            $(elements.get (0)).removeClass (params.hiddenClass);
            params.onActivate (pagination[0], 0, $(elements.get (0)));
            for (var i = 1; i < elementsLength; ++i) {
                $(elements.get (i)).addClass (params.hiddenClass);
                createElementPagination (p, i);
            }
            containerParent.append (p);
            params.onCreatePaginationAfter (p);
        }; // createPagination ();
        
        if (elementsLength > 1) {
            createPagination ();
            var nextElement = null;
            interval = setInterval (function () {
                nextElement = currentIndex + 1;
                if (nextElement >= elementsLength) nextElement = 0;
                goto (nextElement);
            }, params.delay);
        }
    }; // respcarousel ();
})(jQuery);

$(document).ready (function () {
    $('#carousel>ul').respcarousel ({
        onCreateElementPagination: function (e, i) {
            e.html ('<span class="icon-radio-unchecked"></span>');
        }, // onCreateElementPagination ();
        onActivate: function (p, i, e) {
            p.find ('>span').removeClass ('icon-radio-unchecked').addClass ('icon-radio-checked');
        }, // onActivate ();
        onDeactivate: function (p, i, e) {
            p.find ('>span').removeClass ('icon-radio-checked').addClass ('icon-radio-unchecked');
        } // onDeactivate ();
    });
});
