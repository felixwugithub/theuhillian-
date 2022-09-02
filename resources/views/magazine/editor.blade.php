@extends('layout')
@section('content')

    <div class="w-full h-full items-center justify-center mx-auto bg-blue-50 p-5">

<div class="w-3/4 justify-center mx-auto">
        <form
            @if(isset($article))

            action="{{route('club-magazine-update',[
    'id' => $club->id,
    'article_id' => $article->id
]       )}}"

            @else
            action="{{route('club-magazine-store',[
    'id' => $club->id
]       )}}"
            @endif
            enctype="multipart/form-data" method="post">

        @csrf
        @method('POST')

            <div class="relative z-0 mb-6 w-full group  font-ooga">
                <input

                       @if(isset($article->title))
                           value="{{$article->title}}"
                       @else
                           value="{{old('title')}}"
                       @endif

                       type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-5xl text-blue-800 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-150 peer-focus:-translate-y-6">Title</label>
                @error('title')
                <p>{{$message}}</p>
                @enderror
            </div>

            <div class="relative z-0 mb-6 w-full group  font-ooga">
                <input
                    @if(isset($article->author))
                    value="{{$article->author}}"
                    @else
                    value="{{old('author')}}"
                    @endif
                    type="text" name="author" id="author" class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="author" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Author Name</label>
                @error('author')
                <p>{{$message}}</p>
                @enderror
            </div>
        <br>

        <div>

            <input id="x" type="hidden" name="content"
                   @if(isset($article->content))
                   value="{{$article->content}}"
                   @else
                   value="{{old('content')}}"
                   @endif
                   required>
            <trix-editor

                id="content"
                class="trix-editor h-[24rem] overflow-scroll bg-barelyThereBlue" input="x"
                x-data="{
                            upload(event) {
                            const data = new FormData();
                            data.append('attachment', event.attachment.file);
                            window.axios.post('/attachments', data, {
                                onUploadProgress(progressEvent) {
                                    event.attachment.setUploadProgress(
                                        progressEvent.loaded / progressEvent.total * 100
                                    );
                                },
                            }).then(({ data }) => {
                                event.attachment.setAttributes({
                                    url: data.image_url,
                                });
                            });
                        }


                    }
                    "
                x-on:trix-attachment-add="upload"

            </trix-editor>


            @error('content')
            <p>{{$message}}</p>
            @enderror
        </div>

        <br>
        <div class="font-ooga flex space-x-5 items-center">

            @if(isset($article->articlePDF->pdf))
                <p>Current PDF: </p>
                <iframe class="w-14 h-10" src="/storage/articlePDFs/{{$article->articlePDF->pdf}}" frameborder="0"></iframe>
                <label for="pdf">Replace PDF:   </label>
                <input type="file" name="pdf" id="pdf">
                @error('pdf')
                <p>{{$message}}</p>
                @enderror

                <input type="checkbox" id="removePDF" name="removePDF" value="removePDFtrue">
                <label for="removePDF"> Remove PDF</label><br>

            @else
                <label for="pdf">You can also upload a PDF version of your article here:   </label>
                <input type="file" name="pdf" id="pdf">
                @error('pdf')
                <p>{{$message}}</p>
                @enderror
            @endif
        </div>
        <br>

        <button class="bg-ripeBanana p-5 text-lg text-yellow-900 font-ooga hover:border-2 hover:border-yellow-300">Save Article</button>

    </form>



</div>
    </div>

@endsection
