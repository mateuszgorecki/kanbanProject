//--------------------DECLARATIONS--START-----------------------

let todoContainer = document.getElementById("todo")
let progressContainer = document.getElementById("in-progress")
let doneContainer = document.getElementById("done")

let desc = document.getElementById("desc")

let deleteTask = document.getElementById("delete-task")
let yes = document.getElementById("yes")
let no = document.getElementById("no")

let todoList = []
let progressList = []
let doneList = []

let span = document.getElementsByClassName("close")[0]
let span1 = document.getElementsByClassName("close")[1]
//--------------------DECLARATIONS--END-------------------------

function trimDesc() {
  desc.textContent = desc.textContent.slice(0, desc.textContent.indexOf("#"))
  desc.append("#")
  console.log(desc)
}

//--------------------APPENDING--TASKS--START-------------------

function appendTasks(tasks) {
  const string = tasks
  let container = string.split("/")
  container.pop()

  for (let i = 0; i < container.length; i++) {
    switch (container[i]) {
      case "todo":
        pushTodo(createCard(container[i + 1]))
        break

      case "in-progress":
        pushProgress(createCard(container[i + 1]))
        break

      case "done":
        pushDone(createCard(container[i + 1]))
        break
    }
  }
}
//------------------APPENDING--TASKS--END---------------------

span.addEventListener("click", function () {
  deleteTask.style.display = "none"
  console.log(desc)
})

span1.addEventListener("click", function () {
  deleteTask.style.display = "none"
  console.log(desc)
})

window.addEventListener("click", function (event) {
  if (event.target == deleteTask) {
    deleteTask.style.display = "none"
    console.log(desc)
  }
})


//----------------CREATING--CARD--START----------------
function createCard(description) {
  let card = document.createElement("li")
  card.classList.add("card")

  let cardDescription = document.createElement("p")
  cardDescription.classList.add("card-description")
  cardDescription.append(description)

  let cardDelete = document.createElement("button")
  cardDelete.classList.add("btn-delete")
  cardDelete.classList.add("random-name")
  cardDelete.innerText = "X"

  //---------------CARD-DELETE--START---------------

  cardDelete.addEventListener("click", function () {
    deleteTask.style.display = "flex"
    deleteTask.style.justifyContent = "center"
    deleteTask.style.alignItems = "center"

    yes.onclick = function () {
      card.remove()
      let index = todoList.indexOf(card)
      todoList.pop(index)
      deleteTask.style.display = "none"
      console.log(desc)
      setTimeout(trimDesc, 100)
    }
    no.onclick = function () {
      deleteTask.style.display = "none"
      console.log(desc)
      trimDesc()
    }
  })
  //---------------CARD-DELETE--END-----------------

  card.appendChild(cardDescription)
  card.appendChild(cardDelete)
  return card
}

//----------------CREATING--CARD--END------------------

//----------------CHANGE--POSITION--TASK--START--------------------
$(document).on("click", ".card", first)
$(document).on("click", "h4", second)

let task;

function first() {
  let card = $(this)
  task = card
  let cardLength = card[0].textContent.length
  desc.append(card[0].textContent.substr(0, cardLength-1), '#')
  console.log(desc)

  let parent = card.parent().attr('id')

  switch(parent){
    case "todo":
      todoList.pop(card)
      break
    case "in-progress":
      progressList.pop(card)
      break
    case "done":
      doneList.pop(card)
      break
  }
}

function second() {
  let value = $(this).text()
  console.log(desc)

  switch (value) {
    case "todo":
      appendTodo(task[0])
      desc.append('todo')
      console.log(desc)
      break
    case "in progress":
      appendProgress(task[0])
      desc.append('in-progress')
      console.log(desc)
      break
    case "done":
      appendDone(task[0])
      desc.append('done')
      console.log(desc)
      break
  }
  setTimeout(function(){
    trimDesc()
  }, 100)
}

//----------------CHANGE--POSITION--TASK--END----------------------

//----------------APPENDING--CARD--TO--CONTAINERS--START-----------

function appendTodo(card) {
  todoList.push(card)
  todoContainer.appendChild(card)
  console.log(desc)
}

function appendProgress(card) {
  progressList.push(card)
  progressContainer.appendChild(card)
  console.log(desc)
}

function appendDone(card) {
  doneList.push(card)
  doneContainer.appendChild(card)
  console.log(desc)
}

function pushTodo(card) {
  todoList.push(card)
  for (let i = 0; i < todoList.length; i++) {
    todoContainer.appendChild(todoList[i])
  }
}

function pushProgress(card) {
  progressList.push(card)
  for (let i = 0; i < progressList.length; i++) {
    progressContainer.append(progressList[i])
  }
}

function pushDone(card) {
  doneList.push(card)
  for (let i = 0; i < doneList.length; i++) {
    doneContainer.appendChild(doneList[i])
  }
}
//----------------APPENDING--CARD--TO--CONTAINERS--END-------------

export function removeEverything() {
  if (
    todoContainer.hasChildNodes &&
    progressContainer.hasChildNodes &&
    doneContainer.hasChildNodes
  ) {
    todoList.splice(0)
    progressList.splice(0)
    doneList.splice(0)

    while (todoContainer.firstChild) {
      todoContainer.removeChild(todoContainer.firstChild)
    }
    while (progressContainer.firstChild) {
      progressContainer.removeChild(progressContainer.firstChild)
    }

    while (doneContainer.firstChild) {
      doneContainer.removeChild(doneContainer.firstChild)
    }
  } else console.log("all ok!")
}

export default appendTasks