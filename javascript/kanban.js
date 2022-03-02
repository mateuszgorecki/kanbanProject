//--------------------DECLARATIONS--START-----------------------

let todoContainer = document.getElementById("todo")
let progressContainer = document.getElementById("in-progress")
let doneContainer = document.getElementById("done")

let modal = document.getElementById("myModal")
let btn = document.getElementById("todo-button")

let sendTask = document.getElementById("send-task")
let desc = document.getElementById("desc")


let deleteTask = document.getElementById("delete-task")
let yes = document.getElementById("yes")
let no = document.getElementById("no")
let addTask = document.getElementById("add-task")

let todoList = []
let progressList = []
let doneList = []

let span = document.getElementsByClassName("close")[0]
let span1 = document.getElementsByClassName("close")[1]
//--------------------DECLARATIONS--END-------------------------


function trimDesc(){
  desc.textContent = desc.textContent.slice(0, desc.textContent.indexOf('#'))
  desc.append("#")
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

window.onload = function(){
  addTask.style.display = 'none'
}

addTask.addEventListener('click', function(){
  setTimeout(function(){
    trimDesc()
    addTask.style.display = 'none'
    btn.style.display = 'flex'
  }, 100)
})

//-----------------MODAL--ADD--TASK--START--------------------

let todoCheck = window.setInterval(() => {
  console.log(todoList.length)
}, 500)

btn.addEventListener("click", () => {

 if(todoList.length >= 7){
  btn.disabled = true
  alert('You\'ve reached max. amount of tasks in TODO column. You have to wait until employee take some tasks into IN PROGRESS column' )
}
else{
  modal.style.display = "flex"
  modal.style.justifyContent = "center"
  modal.style.alignItems = "center"
}
})

sendTask.addEventListener("click", function () {
  let task = document.getElementById("description").value
  if (task == null) {
    console.log("nothing to add")
  clearInterval(todoCheck)
  } else {
    pushTodo(createCard(task))
    desc.append(task)
    modal.style.display = "none"
    addTask.style.display = 'flex'
    btn.style.display = 'none'
  clearInterval(todoCheck)
  }
  todoCheck()
})

span.addEventListener("click", function () {
  modal.style.display = "none"
  deleteTask.style.display = "none"
  trimDesc()
  todoCheck()
})

span1.addEventListener("click", function () {
  modal.style.display = "none"
  deleteTask.style.display = "none"
  trimDesc()
  todoCheck()
})

window.addEventListener("click", function (event) {
  if (event.target == modal || event.target == deleteTask) {
    modal.style.display = "none"
    deleteTask.style.display = "none"
    trimDesc()
    todoCheck()
  }
})

//-----------------MODAL--ADD--TASK--END----------------------

function createCard(description) {
  let card = document.createElement("li")
  card.classList.add("card")

  let cardDescription = document.createElement("p")
  cardDescription.classList.add("card-description")
  cardDescription.append(description)

  let cardDelete = document.createElement("button");
  cardDelete.classList.add("btn-delete")
  cardDelete.classList.add("random-name")
  cardDelete.innerText = "X"

  cardDelete.addEventListener("click", function () {
    deleteTask.style.display = "flex"
    deleteTask.style.justifyContent = "center"
    deleteTask.style.alignItems = "center"

    yes.onclick = function () {
      card.remove()
      let index = todoList.indexOf(card)
      todoList.pop(index)
      deleteTask.style.display = "none"
      setTimeout(trimDesc, 100)
    }
    no.onclick = function () {
      deleteTask.style.display = "none"
      trimDesc()
    }
  })

  card.appendChild(cardDescription)
  card.appendChild(cardDelete)
  return card
}


//----------------CHANGE--POSITION--TASK--START--------------------

$(document).on("click", ".card", first)
$(document).on("click", "h4", second)

let task

function first() {
  let card = $(this)
  task = card
  let cardLength = card[0].textContent.length
  desc.append(card[0].textContent.substr(0, cardLength-1))

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

  switch (value) {
    case "todo":
      appendTodo(task[0])
      desc.append('#todo')
      break
    case "in progress":
      appendProgress(task[0])
      desc.append('#in-progress')
      break
    case "done":
      appendDone(task[0])
      desc.append('#done')
      break
  }
  setTimeout(function(){
    trimDesc()}, 100)
}

//----------------CHANGE--POSITION--TASK--END----------------------

//----------------APPENDING--CARD--TO--CONTAINERS--START-----------

function appendTodo(card){
  todoList.push(card)
  todoContainer.appendChild(card)
}

function appendProgress(card){
  progressList.push(card)
  progressContainer.appendChild(card)
}

function appendDone(card){
  doneList.push(card)
  doneContainer.appendChild(card)
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
