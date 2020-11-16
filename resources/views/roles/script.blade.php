<script>
    @foreach($types as $type)
        @foreach($type->userActions as $action)
        {{$action->div_id}} = document.getElementById("{{$action->div_id}}");
    @endforeach
        @endforeach

    userold = '{{(is_array(old('actions')) and in_array(1 , old('actions')))}}';
    useredit = '{{old('_token') === null and in_array(1, $array)}}';
    function userload() {
        if(!(userold) && !useredit){
            usercreate.disabled = true;
            userupdate.disabled = true;
            useronoff.disabled = true;
        }
    }
    userload();

    roleold = '{{(is_array(old('actions')) and in_array(5 , old('actions')))}}';
    roleedit = '{{old('_token') === null and in_array(5, $array)}}';
    function roleload() {
        if(!(roleold) && !roleedit){
            roleadd.disabled = true;
            roleupdate.disabled = true;
        }
    }
    roleload();

    readerold = '{{(is_array(old('actions')) and in_array(8 , old('actions')))}}';
    readeredit = '{{old('_token') === null and in_array(8, $array)}}';
    function readerload() {
        if(!(readerold) && !readeredit){
            readercreate.disabled = true;
            readerupdate.disabled = true;
            readeronoff.disabled = true;
        }
    }
    readerload();

    bookold = '{{(is_array(old('actions')) and in_array(12 , old('actions')))}}';
    bookedit = '{{old('_token') === null and in_array(12, $array)}}';
    function bookload() {
        if(!(bookold) && !bookedit){
            //page case
            pageview.disabled = true;

            //book case
            bookcreate.disabled = true;
            bookupdate.disabled = true;
            bookonoff.disabled = true;
            bookdelete.disabled = true;
        }
    }
    bookload();

    pageold = '{{(is_array(old('actions')) and in_array(17 , old('actions')))}}';
    pageedit = '{{old('_token') === null and in_array(17, $array)}}';
    function pageload() {
        if(!(pageold) && !pageedit){
            pageadd.disabled = true;
            pageupdate.disabled = true;
            pagedelete.disabled = true;
        }
    }
    pageload();

    categoryold = '{{(is_array(old('actions')) and in_array(21 , old('actions')))}}';
    categoryedit = '{{old('_token') === null and in_array(21, $array)}}';
    function categoryload() {
        if(!(categoryold) && !categoryedit){
            categoryadd.disabled = true;
            categoryupdate.disabled = true;
        }
    }
    categoryload();

    authorold = '{{(is_array(old('actions')) and in_array(24 , old('actions')))}}';
    authoredit = '{{old('_token') === null and in_array(24, $array)}}';
    function authorload() {
        if(!(authorold) && !authoredit){
            authoradd.disabled = true;
            authorupdate.disabled = true;
        }
    }
    authorload();

    function userviewF(checkboxElem) {
        if (checkboxElem.checked) {
            usercreate.disabled = false;
            userupdate.disabled = false;
            useronoff.disabled = false;
        } else {
            usercreate.disabled = true;
            usercreate.checked = false;
            userupdate.disabled = true;
            userupdate.checked = false;
            useronoff.disabled = true;
            useronoff.checked = false;
        }
    }
    function roleviewF(checkboxElem) {
        if (checkboxElem.checked) {
            roleadd.disabled = false;
            roleupdate.disabled = false;
        } else {
            roleadd.disabled = true;
            roleadd.checked = false;
            roleupdate.disabled = true;
            roleupdate.checked = false;
        }
    }
    function readerviewF(checkboxElem) {
        if (checkboxElem.checked) {
            readercreate.disabled = false;
            readerupdate.disabled = false;
            readeronoff.disabled = false;
        } else {
            readercreate.disabled = true;
            readercreate.checked = false;
            readerupdate.disabled = true;
            readerupdate.checked = false;
            readeronoff.disabled = true;
            readeronoff.checked = false;
        }
    }
    function bookviewF(checkboxElem) {
        if (checkboxElem.checked) {
            //book case
            bookcreate.disabled = false;
            bookupdate.disabled = false;
            bookonoff.disabled = false;
            bookdelete.disabled = false;
            //page case
            pageview.disabled = false;
        } else {
            //book case
            bookcreate.disabled = true;
            bookcreate.checked = false;
            bookupdate.disabled = true;
            bookupdate.checked = false;
            bookonoff.disabled = true;
            bookonoff.checked = false;
            bookdelete.disabled = true;
            bookdelete.checked = false;

            //page case
            pageview.disabled = true;
            pageview.checked = false;
            pageadd.disabled = true;
            pageadd.checked = false;
            pageupdate.disabled = true;
            pageupdate.checked = false;
            pagedelete.disabled = true;
            pagedelete.checked = false;

        }
    }

    function pageviewF(checkboxElem) {
        if (checkboxElem.checked) {
            pageadd.disabled = false;
            pageupdate.disabled = false;
            pagedelete.disabled = false;
        } else {
            pageadd.disabled = true;
            pageadd.checked = false;
            pageupdate.disabled = true;
            pageupdate.checked = false;
            pagedelete.disabled = true;
            pagedelete.checked = false;
        }
    }

    function categoryviewF(checkboxElem) {
        if (checkboxElem.checked) {
            categoryadd.disabled = false;
            categoryupdate.disabled = false;
        } else {
            categoryadd.disabled = true;
            categoryadd.checked = false;
            categoryupdate.disabled = true;
            categoryupdate.checked = false;
        }
    }
    function authorviewF(checkboxElem) {
        if (checkboxElem.checked) {
            authoradd.disabled = false;
            authorupdate.disabled = false;
        } else {
            authoradd.disabled = true;
            authoradd.checked = false;
            authorupdate.disabled = true;
            authorupdate.checked = false;
        }
    }
</script>
