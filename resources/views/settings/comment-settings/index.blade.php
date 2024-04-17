@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Settings')
@section('sub-sub-page-title', 'Comment Settings')
@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Comment Setting</h4>
                </div>
                <div class="card-body form-steps">
                    <form id="commentSettingsForm" action="{{ route('comment-setting.update', $settings->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">
                                <!-- Default Blog settings -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Default Blog settings</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <input type="checkbox" class="mb-2" name="allow_comments" id="allow_comments"
                                                value="1"
                                                {{ isset($settings->allow_comments) && $settings->allow_comments ? 'checked' : '' }}>
                                            <label class="black mb-3 d-inline" for="allow_comments">Allow people to submit
                                                comments on new blogs</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Other comment settings -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Other comment settings</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <input type="checkbox" class="" name="require_name_email"
                                                id="require_name_email" value="1"
                                                {{ isset($settings->require_name_email) && $settings->require_name_email ? 'checked' : '' }}>
                                            <label for="require_name_email" class="black d-inline">Comment author must fill
                                                out name and email</label>
                                        </div>

                                        <div class="mb-3">
                                            <input type="checkbox" class="" name="require_registration"
                                                id="require_registration" value="1"
                                                {{ isset($settings->require_registration) && $settings->require_registration ? 'checked' : '' }}>
                                            <label for="require_registration" class="black d-inline">Users must be
                                                registered and logged in to comment</label>
                                        </div>

                                        <div class="mb-3">
                                            <input type="checkbox" class="" name="close_comments_for_old_blogs"
                                                id="close_comments_for_old_blogs" value="1"
                                                {{ isset($settings->close_comments_for_old_blogs) && $settings->close_comments_for_old_blogs ? 'checked' : '' }}>
                                            <label for="close_comments_for_old_blogs" class="black d-inline">Automatically
                                                close comments on blogs older than
                                                <input type="number" name="close_comments_days_old" step="1"
                                                    min="0" id="small_field"
                                                    value="{{ isset($settings->close_comments_days_old) ? $settings->close_comments_days_old : '1' }}">
                                                days
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Enable threaded (nested) comments -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Enable threaded (nested) comments</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            Enable threaded comments
                                            <select name="nested_levels">
                                                @for ($i = 2; $i <= 10; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ isset($settings->nested_levels) && $settings->nested_levels == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select> levels deep
                                        </div>

                                    </div>
                                </div>

                                <!-- Break comments into pages -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Break comments into pages</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            Break comments into pages with
                                            <input type="number" name="per_page"
                                                value="{{ isset($settings->per_page) ? $settings->per_page : '' }}"
                                                min="1"> top level comments per page and
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment order -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Comment order</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            Comments should be displayed with the
                                            <select name="order">
                                                <option value="newer"
                                                    {{ isset($settings->order) && $settings->order == 'newer' ? 'selected' : '' }}>
                                                    newer</option>
                                                <option value="older"
                                                    {{ isset($settings->order) && $settings->order == 'older' ? 'selected' : '' }}>
                                                    older</option>
                                            </select>
                                            comments at the top of each page
                                        </div>
                                    </div>
                                </div>

                                <!-- Email me whenever -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Email me whenever</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <input type="checkbox" name="email_on_comment" id="email_on_comment"
                                                value="1"
                                                {{ isset($settings->email_on_comment) && $settings->email_on_comment ? 'checked' : '' }}>
                                            <label for="email_on_comment" class="black d-inline">Anyone posts a
                                                comment</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- A comment is held for moderation -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">A comment is held for moderation</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <input type="checkbox" name="moderation" id="moderation" value="1"
                                                {{ isset($settings->moderation) && $settings->moderation ? 'checked' : '' }}>
                                            <label for="moderation" class="black d-inline">A comment is held for
                                                moderation</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Before a comment appears -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Before a comment appears</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <input type="checkbox" name="manual_approval" id="manual_approval"
                                                value="1"
                                                {{ isset($settings->manual_approval) && $settings->manual_approval ? 'checked' : '' }}>
                                            <label for="manual_approval" class="black d-inline">Comment must be manually
                                                approved</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment Moderation -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Comment Moderation</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            Hold a comment in the queue if it contains
                                            <input type="number" name="links_threshold"
                                                value="{{ isset($settings->links_threshold) ? $settings->links_threshold : '' }}"
                                                min="1">
                                            or more links. (A common characteristic of comment spam is a large number of
                                            hyperlinks.)
                                        </div>
                                        <div class="mb-3">
                                            When a comment contains any of these words in its content, author name, URL,
                                            email, IP address, or browser’s user agent string, it will be held in thepending
                                            queue One word or IP address per line. It will match inside words, so “press”
                                            will match “WordPress”.
                                            <textarea class="form-control mt-2" id="exampleFormControlTextarea5" rows="3" name="hold_keywords">{{ isset($settings->hold_keywords) ? $settings->hold_keywords : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment Moderation -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Comment Moderation</span>
                                    </div>
                                    <div class="col-md-9">

                                        <div class="mb-3">
                                            When a comment contains any of these words in its content, author name, URL,
                                            email, IP address, or browser’s user agent string, it will be put in the Trash.
                                            One word or IP address per line. It will match inside words, so “press” will
                                            match “WordPress”.
                                            <textarea class="form-control mt-2" id="exampleFormControlTextarea5" rows="3" name="disallowed_keywords">{{ isset($settings->disallowed_keywords) ? $settings->disallowed_keywords : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 row my-4">
                                    <div class="col-md-12">
                                        <span class="font-16 black bold">Avatars</span>
                                        <p class="mt-4 black">
                                            An avatar is an image that can be associated with a user across multiple
                                            websites. In this area, you can choose to display avatars of users who interact
                                            with the site.
                                        </p>
                                    </div>
                                </div>

                                <!-- Avatars -->
                                <div class="col-md-12 row my-3">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Avatar Display</span>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-3">
                                            <input type="checkbox" name="display_avatars" id="display_avatars"
                                                value="1"
                                                {{ isset($settings->display_avatars) && $settings->display_avatars ? 'checked' : '' }}>
                                            <label for="display_avatars" class="black d-inline">Show Avatars</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 row my-3" id="avatar_settings">
                                    <div class="col-md-3 mb-2">
                                        <span class="font-16 black bold">Default Avatar</span>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="black">
                                            For users without a custom avatar of their own, you can either display a generic
                                            logo or a generated one based on their email address.
                                        </p>
                                        <!--Mystery Avatar -->
                                        <div class="mb-2">
                                            <input type="radio" class="mb-3" name="default_avatar" id="mystery"
                                                value="mystery" checked="">
                                            <img src="https://cmslooks.themelooks.us/public/comment-author-image/mystery.png"
                                                alt="">
                                            <label for="mystery" class="black">Mystery Person</label><br>
                                        </div>

                                        <!--Blank Avatar -->
                                        <div class="mb-2">
                                            <input type="radio" class="mb-3" name="default_avatar" id="blank"
                                                value="blank">
                                            <img src="https://cmslooks.themelooks.us/public/comment-author-image/blank.png"
                                                alt="">
                                            <label for="blank" class="black">Blank</label><br>
                                        </div>

                                        <!--Gravatar Avatar -->
                                        <div class="mb-2">
                                            <input type="radio" class="mb-3" name="default_avatar" id="gravatar"
                                                value="gravatar">
                                            <img src="https://cmslooks.themelooks.us/public/comment-author-image/gravatar.png"
                                                alt="">
                                            <label for="gravatar" class="black">Gravatar Logo</label><br>
                                        </div>

                                        <!--Identicon Avatar -->
                                        <div class="mb-2">
                                            <input type="radio" class="mb-3" name="default_avatar" id="identicon"
                                                value="identicon">
                                            <img src="https://cmslooks.themelooks.us/public/comment-author-image/identicon.png"
                                                alt="">
                                            <label for="identicon" class="black">Identicon (Generated)</label><br>
                                        </div>

                                        <!--Wavatar Avatar -->
                                        <div class="mb-2">
                                            <input type="radio" class="mb-3" name="default_avatar" id="wavatar"
                                                value="wavatar">
                                            <img src="https://cmslooks.themelooks.us/public/comment-author-image/wavatar.png"
                                                alt="">
                                            <label for="wavatar" class="black">Wavatar (Generated)</label><br>
                                        </div>

                                        <!--MonsterId Avatar -->
                                        <div class="mb-2">
                                            <input type="radio" class="mb-3" name="default_avatar" id="monsterid"
                                                value="monsterid">
                                            <img src="https://cmslooks.themelooks.us/public/comment-author-image/monsterid.png"
                                                alt="">
                                            <label for="monsterid" class="black">MonsterID (Generated)</label><br>
                                        </div>

                                        <!--Retro Avatar -->
                                        <div class="">
                                            <input type="radio" class="mb-3" name="default_avatar" id="retro"
                                                value="retro">
                                            <img src="https://cmslooks.themelooks.us/public/comment-author-image/retro.png"
                                                alt="">
                                            <label for="retro" class="black">Retro (Generated)</label><br>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row ">
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary sm">Save Changes</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                </div>
            </div>

            </form>


        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
    </div>
    <!-- end col -->
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#commentSettingsForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();


                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        console.log(response)
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    '{{ route('comment-setting.index') }}';
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (let field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    errorMessage += `${errors[field].join('\n')}\n`;
                                }
                            }

                            Swal.fire(
                                'Error!',
                                errorMessage + '\n',
                                'error'
                            );
                        }
                });
            });
        });
    </script>



@endsection
