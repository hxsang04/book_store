@extends('admin.layout.master')

@section('content')
    <style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 400px;
    }
    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
    </style>
    
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Sản phẩm</h5>
                <form method="POST" action="{{route('product.edit', $product)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên 
                            <span class="text-danger">*</span> 
                        </label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name', $product->name)}}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="publisher" class="form-label">Nhà xuất bản
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="publisher_id" id="publisher">
                            <option value="" disabled selected>--- Chọn nhà xuất bản ---</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{$publisher->id}}" {{$publisher->id == $product->publisher_id ? 'selected' : '' }}>{{$publisher->name}}</option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Nhà xuất bản
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="author_id" id="author">
                            <option value="" disabled selected>--- Chọn nhà xuất bản ---</option>
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}" {{$author->id == $product->author_id ? 'selected' : '' }}>{{$author->name}}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Thể loại
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="category_id" id="category">
                            <option value="" disabled selected>--- Chọn thể loại ---</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="initial_price" class="form-label">Giá gốc
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="initial_price" id="initial_price" value="{{initialPrice($product->price, $product->discount)}}">
                        @error('initial_price')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">Chiết khấu (%)</label>
                        <input type="text" class="form-control" name="discount" id="discount" value="{{$product->discount}}">
                        @error('discount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giá bán <small>(sau chiết khấu)</small>
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" value="{{$product->price}}" id="price" readonly disabled>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="{{$product->quantity}}">
                        @error('quantity')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="description" id="editor">{{$product->description}}</textarea>
                        @error('description')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label me-2">Hình ảnh
                            <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="image" class="form-control" id="product-img" accept="image/*" />
                        @error('image')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                        <img id="imagePreview" class="m-3 rounded-1" src="{{$product->image}}" width="100">
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
        
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: '',
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        });
    </script>

@endsection