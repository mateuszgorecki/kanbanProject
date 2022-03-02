import appendTasks, { removeEverything } from "./kanban.js"


$(document).on("click", "div.collumn", function () {
  var borowik = $(this).attr("value")
  $.ajax({
    type: "POST",
    data: {
      id: borowik,
    },
    url: "listowanie_zadan.php",
    success: function (response) {
      removeEverything()
      appendTasks(response)
    },
  })
})

$(document).on("click", "div.collumn", function () {
  let borowik = $(this).attr("value")
  let desc = document.getElementById("desc")

  while (desc.firstChild) {
    desc.removeChild(desc.firstChild)
  }
  desc.append(borowik, "#")
})
