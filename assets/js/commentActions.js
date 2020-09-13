function postComment(button, postedBy, videoId, replayTo, containerClass){
  // textareaの階層にいる物を全て選択できる
  var textarea = $(button).siblings("textarea");
  var commentText = textarea.val();
  // ここでtextareaの中身をからにする。
  textarea.val("");

  if(commentText){
    $.post("ajax/postComment.php", {commentText: commentText, postedBy: postedBy, videoId: videoId, responseTo: replayTo})
    .done(function(comment){
      
      $("." + containerClass).prepend(comment);
    });

  } else {
    alert("You can not post an empty comment");
  }
}