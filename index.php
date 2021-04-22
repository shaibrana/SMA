<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Supermetrics Assignment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    </head>
    <body>

        <div class="container">
            <h1 class="mb-3 mt-3">Supermetrics Assignment</h1>
            
            <div class="row mb-5">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" id="getResults">Get Results</button>
                </div>
            </div>
            <div class="spinner-border loader" role="status" style="display: none;">
                <span class="sr-only">Loading...</span>
            </div>
           
            <div id="result" class="row" style="display: none;">
                <div class="col-12 mb-5">
                    <label class="font-weight-bold mb-3">Average character length of posts per month</label>
                    <table class="table" id="avgLengthTable"></table>
                </div>
                <div class="col-12 mb-5">
                    <label class="font-weight-bold mb-3">Longest post by character length per month</label>
                    <table class="table" id="longPostTable">
                        <thead>
                            <th>
                                Month
                            </th>
                            <th>
                                Length
                            </th>
                            <th>
                                Post
                            </th>
                        <thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mb-5">
                    <label class="font-weight-bold mb-3">Total posts split by week number</label>
                    <table class="table" id="weekPostsTable">
                        <thead>
                            <th>
                                Week #
                            </th>
                            <th>
                                Posts
                            </th>
                        <thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mb-5">
                    <label class="font-weight-bold mb-3">Average number of posts per user per month</label>
                    <table class="table" id="avgPostsTable"></table>
                </div>
            </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    <script src="assets/script.js"></script>
</html>