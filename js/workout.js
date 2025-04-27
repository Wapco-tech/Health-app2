function toggleSidebar() {  
    const sidebar = document.getElementById('sidebar');  
    sidebar.classList.toggle('active');  
}  

// JavaScript for touch-based label display  
const bottomLinks = document.querySelectorAll('.bottom-menu a');  
bottomLinks.forEach(link => {  
    link.addEventListener('touchstart', () => {  
        link.classList.add('touched');  
    });  

    link.addEventListener('touchend', () => {  
        setTimeout(() => { // Small delay for better UX  
            link.classList.remove('touched');  
        }, 200);  
    });  
});  

document.querySelectorAll(".muscle-groups svg g g[id]").forEach(function(group) {
    // For the hover
    group.addEventListener('mouseover', function(el) {
      let id = el.path[1].id.toLowerCase()
      if(!id) id = el.path[2].id.toLowerCase()
      let label = document.querySelectorAll("label[for=" + id + "]")[0]
      if (label.classList)
        label.classList.add("hover")
      else
        label.className += ' ' + "hover"
    })
    group.addEventListener('mouseout', function(el) {
      let id = el.path[1].id.toLowerCase()
      if(!id) id = el.path[2].id.toLowerCase()
      let label = document.querySelectorAll("label[for=" + id + "]")[0]
      let clss = "hover"
      if (label.classList)
        label.classList.remove(clss)
      else
        label.className = label.className.replace(new RegExp('(^|\\b)' + clss.split(' ').join('|') + '(\\b|$)', 'gi'), ' ')
    })
    // For the click
    group.addEventListener('click', function(el) {
      let id = el.path[1].id.toLowerCase()
      if(!id) id = el.path[2].id.toLowerCase()
      let input = document.getElementById(id)
      if(input.checked) input.checked = false
      else input.checked = true
    });
  })