var data = {
    chatinit: {
        title: ["Hello <span class='emoji'> &#128075;</span>", "I am TravelBot", "How can I assist you today?"],
        options: ["Destinations <span class='emoji'> &#127754;</span>", "Activities", "Hotels <span class='emoji'> &#127970;</span>", "Travel Tips <span class='emoji'> &#128202;</span>"]
    },
    destinations: {
        title: ["Please select a destination category"],
        options: ["Asia", "Europe", "America", "Africa"],
        url: {}
    },
    activities: {
        title: ["What type of activities are you interested in?"],
        options: ["Adventure", "Cultural", "Relaxation", "Sightseeing"],
        url: {}
    },
    hotels: {
        title: ["Here are some hotel options for you"],
        options: ["Luxury Hotels", "Budget Hotels", "Boutique Hotels", "Resorts"],
        url: {}
    },
    travelTips: {
        title: ["Here are some travel tips to consider"],
        options: ["Packing Tips", "Budgeting", "Safety Tips", "Travel Insurance"],
        url: {}
    },
    asia: {
        title: ["Thanks for your response", "Here are some popular destinations in Asia"],
        options: ["Tokyo", "Bali", "Bangkok", "Singapore"],
        url: {
            more: "https://www.youtube.com/@travelvlogs/videos",
            link: ["#","#","#","#"]
        }
    },
    europe: {
        title: ["Thanks for your response", "Here are some popular destinations in Europe"],
        options: ["Paris", "Rome", "London", "Berlin"],
        url: {
            more: "https://www.youtube.com/@travelvlogs/videos",
            link: ["#","#","#","#"]
        }
    },
    america: {
        title: ["Thanks for your response", "Here are some popular destinations in America"],
        options: ["New York", "Los Angeles", "Miami", "Chicago"],
        url: {
            more: "https://www.youtube.com/@travelvlogs/videos",
            link: ["#","#","#","#"]
        }
    },
    africa: {
        title: ["Thanks for your response", "Here are some popular destinations in Africa"],
        options: ["Cape Town", "Marrakech", "Nairobi", "Cairo"],
        url: {
            more: "https://www.youtube.com/@travelvlogs/videos",
            link: ["#","#","#","#"]
        }
    },
    adventure: {
        title: ["Thanks for your response", "Here are some adventure activities you can try"],
        options: ["Hiking", "Skydiving", "Scuba Diving", "Bungee Jumping"],
        url: {
            more: "https://www.youtube.com/@adventurevlogs/videos",
            link: ["#","#","#","#"]
        }
    },
    cultural: {
        title: ["Thanks for your response", "Here are some cultural activities you can explore"],
        options: ["Museum Tours", "Local Festivals", "Culinary Experiences", "Historical Sites"],
        url: {
            more: "https://www.youtube.com/@culturalvlogs/videos",
            link: ["#","#","#","#"]
        }
    },
    relaxation: {
        title: ["Thanks for your response", "Here are some relaxing activities"],
        options: ["Spa Treatments", "Beach Resorts", "Yoga Retreats", "Nature Walks"],
        url: {
            more: "https://www.youtube.com/@relaxationvlogs/videos",
            link: ["#","#","#","#"]
        }
    },
    sightseeing: {
        title: ["Thanks for your response", "Here are some sightseeing options"],
        options: ["City Tours", "National Parks", "Landmark Visits", "Scenic Drives"],
        url: {
            more: "https://www.youtube.com/@sightseeingvlogs/videos",
            link: ["#","#","#","#"]
        }
    }
};

document.getElementById("init").addEventListener("click", showChatBot);
var cbot = document.getElementById("chat-box");

var len1 = data.chatinit.title.length;

function showChatBot() {
    console.log(this.innerText);
    if (this.innerText == 'START CHAT') {
        document.getElementById('test').style.display = 'block';
        document.getElementById('init').innerText = 'CLOSE CHAT';
        initChat();
    } else {
        location.reload();
    }
}

function initChat() {
    j = 0;
    cbot.innerHTML = '';
    for (var i = 0; i < len1; i++) {
        setTimeout(handleChat, (i * 500));
    }
    setTimeout(function () {
        showOptions(data.chatinit.options)
    }, ((len1 + 1) * 500))
}

var j = 0;
function handleChat() {
    console.log(j);
    var elm = document.createElement("p");
    elm.innerHTML = data.chatinit.title[j];
    elm.setAttribute("class", "msg");
    cbot.appendChild(elm);
    j++;
    handleScroll();
}

function showOptions(options) {
    for (var i = 0; i < options.length; i++) {
        var opt = document.createElement("span");
        var inp = '<div>' + options[i] + '</div>';
        opt.innerHTML = inp;
        opt.setAttribute("class", "opt");
        opt.addEventListener("click", handleOpt);
        cbot.appendChild(opt);
        handleScroll();
    }
}

function handleOpt() {
    console.log(this);
    var str = this.innerText;
    var textArr = str.split(" ");
    var findText = textArr[0].toLowerCase();

    document.querySelectorAll(".opt").forEach(el => {
        el.remove();
    })
    var elm = document.createElement("p");
    elm.setAttribute("class", "test");
    var sp = '<span class="rep">' + this.innerText + '</span>';
    elm.innerHTML = sp;
    cbot.appendChild(elm);

    console.log(findText);
    var tempObj = data[findText];
    handleResults(tempObj.title, tempObj.options, tempObj.url);
}

function handleDelay(title) {
    var elm = document.createElement("p");
    elm.innerHTML = title;
    elm.setAttribute("class", "msg");
    cbot.appendChild(elm);
}

function handleResults(title, options, url) {
    for (let i = 0; i < title.length; i++) {
        setTimeout(function () {
            handleDelay(title[i]);
        }, i * 500)

    }

    const isObjectEmpty = (url) => {
        return JSON.stringify(url) === "{}";
    }

    if (isObjectEmpty(url) == true) {
        console.log("having more options");
        setTimeout(function () {
            showOptions(options);
        }, title.length * 500)

    } else {
        console.log("end result");
        setTimeout(function () {
            handleOptions(options, url);
        }, title.length * 500)

    }
}

function handleOptions(options, url) {
    for (var i = 0; i < options.length; i++) {
        var opt = document.createElement("span");
        var inp = '<a class="m-link" href="' + url.link[i] + '">' + options[i] + '</a>';
        opt.innerHTML = inp;
        opt.setAttribute("class", "opt");
        cbot.appendChild(opt);
    }
    var opt = document.createElement("span");
    var inp = '<a class="m-link" href="' + url.more + '">' + 'See more</a>';

    const isObjectEmpty = (url) => {
        return JSON.stringify(url) === "{}";
    }

    console.log(isObjectEmpty(url));
    console.log(url);
    opt.innerHTML = inp;
    opt.setAttribute("class", "opt link");
    cbot.appendChild(opt);
    handleScroll();
}

function handleScroll() {
    var elem = document.getElementById('chat-box');
    elem.scrollTop = elem.scrollHeight;
}
