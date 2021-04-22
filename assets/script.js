/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    $('#getResults').on('click', function () {
        $("#getResults").attr("disabled", true);
        $("#getResults").css('cursor', 'not-allowed');
        $(".loader").show();
        
        $.getJSON("getResults.php", function (result) {
            var avgLength = result.avgLength;
            showAvgLength(avgLength);

            var longPost = result.longPost;
            showLongPosts(longPost);

            var weekPosts = result.postsByWeek;
            showWeekPosts(weekPosts);

            var postsByUsers = result.postsByUsers;
            showAvgPosts(postsByUsers);
            
            $("#result").show();
            $(".loader").hide();
            
            $("#getResults").attr("disabled", false);
            $("#getResults").css('cursor', 'pointer');

        });
    });
});

function showAvgLength(avgLength) {
    var columns = [];
    for (var key in avgLength) {
        var innerColumns = {};
        innerColumns.field = key;
        innerColumns.title = key;
        columns.push(innerColumns);
    }
    $('#avgLengthTable').bootstrapTable({
        columns: columns,
        data: [avgLength]
    });
    $('#avgLengthTable').bootstrapTable('load', [avgLength]);
}

function showLongPosts(longPost) {
    for (var key in longPost) {
        var row = "<tr><td>" + key + "</td><td>" + longPost[key]['length'] + "</td><td>" + longPost[key]['message'] + "</td></tr>";
        $("#longPostTable tbody").append(row);
    }
}

function showWeekPosts(weekPosts){
    for (var key in weekPosts) {
        var row = "<tr><td>" + key + "</td><td>" + weekPosts[key] + "</td></tr>";
        $("#weekPostsTable tbody").append(row);
    }
}

function showAvgPosts(postsByUsers) {
    var columns = [];
    for (var key in postsByUsers) {
        var innerColumns = {};
        innerColumns.field = key;
        innerColumns.title = key;
        columns.push(innerColumns);
    }
    $('#avgPostsTable').bootstrapTable({
        columns: columns,
        data: [postsByUsers]
    });
    $('#avgPostsTable').bootstrapTable('load', [postsByUsers]);
}
