<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- main css-->
    <link rel="stylesheet" href="css/main.css">
    <!-- Links for Cropper-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="cropper.css">
    <script src="cropper.js"></script>


    <!-- <script type="module" src="cropper/cropper.esm.js"></script> -->
    <style>
        .cropper-cop {
            display: none;
        }

        .cropper-bg {
            background: none;
        }
    </style>


    <title>Admin!</title>
</head>

<body>
    <div class="fetchnews">
        <h2>Admin News Preview</h2>

        <!-- <div><img src="" alt="Image Load Here.." id="imagetest"></div> -->

        <div class="form-group">
            <label for="title">Api</label>
            <input type="text" class="form-control" id="api" aria-describedby="emailHelp"
                value="https://newsapi.org/v2/top-headlines?country=in&category=sports&apiKey=1912042b348c4ec08eb82c52ea3b8ac9">
            <small id="emailHelp" class="form-text text-muted">Customize url with query</small>
        </div>
        <button type="button" class="btn btn-primary btn-sm" onclick="fetchNews()">Fetch Data</button>

    </div>

    <div class="container">

        <div class="row">

            <div class="col">
                <form>
                    <div class="form-group ">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">News Title</small>
                    </div>
                    <!-- <div class="card" style="width: 35rem;"> -->
                    <div><img src="" alt="Image Load Here.." id="newsImage"></div>
                    <!-- </div> -->
                    <div class="form-group">
                        <label for="Desc">Desc</label>
                        <textarea class="form-control" rows="3" id="desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Url">Url</label>
                        <input type="text" class="form-control" id="newsurl">
                    </div>
                    <div class="form-group">
                        <label for="Url to Image">Url to Image</label>
                        <input type="text" class="form-control" id="UrltoImage">
                    </div>
                    <div class="form-group">
                        <label for="Source">Source</label>
                        <input type="text" class="form-control" id="newssource" value="">
                    </div>


                    <button type="reset" class="btn btn-primary btn-sm">Clear</button>&nbsp;
                    <button type="button" class="btn btn-primary btn-sm" id="btn_prev"
                        onclick="prevPage()">Prev</button>
                    &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-primary btn-sm" id="btn_next"
                        onclick="nextPage()">Next</button>
                    Page: <span id="page"></span>
                    <button type="button" class="btn btn-primary btn-sm" id="btn_next"
                        onclick="dataCopy()">Copy</button> &nbsp;
                    <strong>Copy Status: </strong><span id="status"></span>
                </form>
            </div>
            <div class="col">
                <div>
                    <form>
                        <div class="form-group ">
                            <label for="title">Final Title</label>
                            <input type="text" class="form-control" id="finaltitle" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">News Title</small>
                        </div>

                        <div><img src="" alt="Image Load Here.." id="finalnewsImage"></div>



                        <div class="form-group">
                            <label for="Desc">Final Desc</label>
                            <textarea class="form-control" rows="3" id="finaldesc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Url">Final Url</label>
                            <input type="text" class="form-control" id="finalnewsurl">
                        </div>
                        <div class="form-group">
                            <label for="Url to Image">Final Url to Image</label>
                            <input type="text" class="form-control" id="finalUrltoImage">
                        </div>
                        <div class="form-group">
                            <label for="Source">Final Source</label>
                            <input type="text" class="form-control" id="finalnewssource" value="">
                        </div>

                        <button type="reset" class="btn btn-primary btn-sm">Clear</button>&nbsp;
                        <button type="button" class="btn btn-primary btn-sm" id="btn_next"
                            onclick="dataLoad()">Load</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btn_next"
                            onclick="uploadFile()">Save</button>

                    </form>


                </div>

            </div>

        </div>



        <!-- main scrpt-->
        <script type="text/javascript">


            // $('#newsImage').cropper({
            //     aspectRatio: 16 / 9,

            // });

            // --- News Related Varibales and Function---------------
            var newsData;
            var totalResult = 0;
            var api = document.getElementById("api");

            var newssource = document.getElementById("newssource");
            var title = document.getElementById("title");
            var desc = document.getElementById("desc");
            var newsImage = document.getElementById("newsImage");
            var urltoimage = document.getElementById("UrltoImage");
            var newsurl = document.getElementById("newsurl");

            //------------- Final News Forms Varibales-----------------------
            var finalnewssource = document.getElementById("finalnewssource");
            var finaltitle = document.getElementById("finaltitle");
            var finaldesc = document.getElementById("finaldesc");
            var finalnewsImage = document.getElementById("finalnewsImage");
            var finalurltoimage = document.getElementById("finalUrltoImage");
            var finalnewsurl = document.getElementById("finalnewsurl");



            //-------------Paignation Related Data-------------------
            var current_page = 1;
            var records_per_page = 1;  // do not chnage it 


            function prevPage() {
                if (current_page > 1) {
                    current_page--;
                    changePage(current_page);
                }
            }

            function nextPage() {
                if (current_page < numPages()) {
                    current_page++;
                    changePage(current_page);
                }
            }
            // --- main chane page function ----
            function changePage(page) {

                // console.log(newsData.articles.length);
                if (newsData.articles.length <= 0) {
                    alert("Sorry! Now News Found")
                }

                var btn_next = document.getElementById("btn_next");
                var btn_prev = document.getElementById("btn_prev");
                // var listing_table = document.getElementById("listingTable");
                var page_span = document.getElementById("page");

                // Validate page
                if (page < 1) page = 1;
                if (page > numPages()) page = numPages();

                // listing_table.innerHTML = "";
                //$('#imagetest').cropper('destroy');
                for (var i = (page - 1) * records_per_page; i < (page * records_per_page); i++) {
                    //listing_table.innerHTML += objJson[i].adName + "<br>";
                    title.value = newsData.articles[i].title;
                    desc.value = newsData.articles[i].description;
                    newssource.value = newsData.articles[i].source.name;
                    newsurl.value = newsData.articles[i].url;
                    urltoimage.value = newsData.articles[i].urlToImage;
                    newsImage.src = newsData.articles[i].urlToImage;

                    // imgaeTest.src = newsData.articles[i].urlToImage;
                    // $("#imagetest").removeAttr("src").attr("src", "");
                    // $('#newsImage').cropper('destroy');

                    // $('#newsImage').cropper('replace', newsData.articles[i].urlToImage, false)
                    // $('#imagetest').attr('src', newsData.articles[i].urlToImage);
                    // $('#newsImage').cropper({
                    //     aspectRatio: 16 / 9,

                    // });

                }
                page_span.innerHTML = page;

                if (page == 1) {
                    btn_prev.style.visibility = "hidden";
                } else {
                    btn_prev.style.visibility = "visible";
                }

                if (page == numPages()) {
                    btn_next.style.visibility = "hidden";
                } else {
                    btn_next.style.visibility = "visible";
                }
            }

            function numPages() {
                return Math.ceil(newsData.articles.length / records_per_page);
            }


            function fetchNews() {

                //clear old data
                title.value = "";
                desc.value = "";
                newssource.value = "";
                newsurl.value = "";
                urltoimage.value = "";
                newsImage.src = "";

                var api_news = api.value;
                // Replace ./data.json with your JSON feed
                fetch(api_news)
                    .then(response => {
                        return response.json()
                    })
                    .then(data => {
                        // Work with JSON data here
                        newsData = data;
                        console.log(newsData);
                        changePage(1);

                    })
                    .catch(err => {
                        // Do something for an error here
                        console.log(err);
                    })
            }


            function dataCopy() {  // Just only Single Serverside call when copy button clicked
                document.getElementById("status").innerHTML = "Start Copying"
                document.getElementById("status").style.color = "RED";
                var url = urltoimage.value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("status").style.color = "GREEN";
                        document.getElementById("status").innerHTML = "Copy Done"
                        console.log("Save to Server");
                    }
                };
                xmlhttp.open("GET", "saveimage.php?image=" + url, true);
                xmlhttp.send();

            }

            function dataLoad() {
                //Load the Final Form Data 
                loadFinalFormData()
                //Load Final Image and Add Copper
                $('#finalnewsImage').cropper({
                    aspectRatio: 4 / 3,

                });

                d = new Date();
                const currnt_domain = window.location.href;
                const imgurl = currnt_domain + '/news_images/image.jpg?';
                // $('#finalnewsImage').attr('src', imgurl+d.getTime());

                $('#finalnewsImage').cropper('replace', imgurl + d.getTime(), false)



            }

            function loadFinalFormData() {
                // add validation and other stuff to final form
                finaltitle.value = title.value;
                finaldesc.value = desc.value;
                finalnewssource.value = newssource.value;
                finalnewsurl.value = newsurl.value;
                finalurltoimage.value = urltoimage.value;
            }



            // Upload To Server or PostHappening
            function uploadFile() {

                const currnt_domain = window.location.href;
                const imgurl = currnt_domain + '/news_images/image.jpg?';
                d = new Date();
                const final_url = imgurl + d.getTime();

                fetch(final_url)
                    .then(res => res.blob()) // Gets the response and returns it as a blob similar to File object
                    .then(blob => {

                        sendImage(blob);


                    });


            }

            // Actual upload image file object

            function sendImage(myfile) {
                var formData = new FormData();
                formData.append('fileToUpload', myfile); // to add custom image name -> formData.append('fileToUpload',myfile,'myname');

                $.ajax(' ProcessData.php', {
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (e) {
                        alert(e);
                    },
                    error: function () {
                        console.log("Error Not Upload");
                    }
                });
            }


        </script>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        <p></p>
        <footer> <a href="https://newsapi.org/">Powered By https://newsapi.org/</a></footer>
</body>


</html>