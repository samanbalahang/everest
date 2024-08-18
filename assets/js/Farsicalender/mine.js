window.addEventListener('load', () => {
    let getActiveMonth = () => {
        // console.log("getActiveMonth");   
        ActiveMonth.setAttribute("class","");    
        let active = document.querySelector(".active-season-cr");
        ActiveMonth.innerText = active.innerText;
        ActiveMonth.classList.add(active.classList[0]);
        ActiveMonth.classList.add(active.classList[1]);
        ActiveMonth.classList.add(active.classList[2]);
    }
    getActiveMonth();
    leftArrow.addEventListener("click", (e) => {
        let mounth = document.querySelectorAll(".month-hover");
        let monthLength = mounth.length - 1;
        let i = 0;
        let j = 0;
        e.preventDefault();
        mounth.forEach((item) => {
            if (item.classList.contains("active-season-cr")) {
                j = i + 1;

                if (j > monthLength) {
                   j = 1;
                }
            }
            i++;
            item.addEventListener("click", () => {
                getActiveMonth();
            })
        })
        mounth[j].click();
    });
    rightArrow.addEventListener("click",(e)=>{
        let mounth = document.querySelectorAll(".month-hover");
        let monthLength = mounth.length - 1;
        let i = 0;
        let j = 0;
        e.preventDefault();
        mounth.forEach((item) => {
            if (item.classList.contains("active-season-cr")) {
                j = i - 1;
                if (j <= 0) {
                    j = monthLength;                   
                }
            }
            i++ ;
            item.addEventListener("click", () => {
                getActiveMonth();
            })
        });
        mounth[j].click();
    });

    
    
});




