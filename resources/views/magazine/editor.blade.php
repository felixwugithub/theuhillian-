@extends('layout')
@section('content')

    <div class="bg-blue-50">



        <div class="pt-10 pl-14 hover:font-ooga hover:text-spicyPink">
        <a href="{{route('club-magazine-manager', ['id' => $club->id])}}">
            <div class="p-3 w-24 h-12ml-12 font-slim">
                < Back
            </div>

            <div class="block md:hidden text-2xs gray-400 font-ooga text-center flex mx-auto">
                <p>We Recommend Using A Laptop For This Editor</p>
            </div>
        </a>
        </div>


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

            <div class="space-y-3 items-center">

                <div class="font-ooga flex space-x-5 items-center justify-between">


                    @if(isset($article->articlePDF->pdf))

                        <div>
                            <p>Current PDF: </p>
                             <iframe class="w-14 h-10" src="/storage/articlePDFs/{{$article->articlePDF->pdf}}" frameborder="0"></iframe>
                        </div>

                        <div class="w-1/3">
                        <label for="pdf">Replace PDF:   </label>
                        <input type="file" name="pdf" id="pdf">
                        @error('pdf')
                        <p>{{$message}}</p>
                        @enderror
                        </div>

                        <div class="flex space-x-1">
                            <label for="removePDF"> Remove PDF</label><br>
                             <input type="checkbox" id="removePDF" name="removePDF" value="removePDFtrue">

                         </div>

                    @else
                        <label for="pdf" class="text-2xs">Original PDf (optional):   </label>
                        <input type="file" name="pdf" id="pdf">
                        @error('pdf')
                        <p>{{$message}}</p>
                        @enderror
                    @endif

                </div>

                    <div class="font-ooga flex space-x-5 items-center justify-between">

                        @if(isset($article->cover->image))
                            <div>
                                 <p>Current Cover Image: </p>
                                 <iframe class="w-14 h-10" src="/storage/articleCovers/{{$article->cover->image}}" frameborder="0"></iframe>
                            </div>

                            <div class="w-1/3">
                                 <label for="cover">Replace Image:   </label>
                                 <input type="file" name="cover" id="cover">
                             </div>
                            @error('cover')
                            <p>{{$message}}</p>
                            @enderror

                            <div class="flex space-x-1">
                                <label for="removeCover"> Remove Cover Image</label><br>
                                <input type="checkbox" id="removeCover" name="removeCover" value="removeCovertrue">

                            </div>

                        @else
                            <label for="pdf" class="text-2xs">Cover Image (optional):   </label>
                            <input type="file" name="cover" id="cover" >
                            @error('cover')
                            <p>{{$message}}</p>
                            @enderror
                        @endif
                    </div>
            </div>
        <br>

        <button type="submit" class="bg-ripeBanana p-5 text-lg text-yellow-900 font-ooga hover:border-2 hover:border-yellow-300">Save Article</button>

        </form>



        </div>

    </div>


    </div>
@endsection
