import Api from "./apis";
import {createToast} from "./bulma/toasts";
import {addEvent, deleteEvent} from "./baseEvents";

try {
    function deleteClickEvent(e) {
        let id = this.getAttribute("data-id");
        deleteEvent(method, id, (e)=>{
            document.querySelector("#language-panel-"+id).remove()
        })
    }

    var deleteButton =  document.querySelectorAll(".delete-lang");

    var method = "LanguagesUser";

    [].forEach.call(deleteButton, function(elem) {
        elem.addEventListener('click', deleteClickEvent, false);
    });

    var addButton = document.querySelector("#addLanguage");
    if (addButton !== null) {
        addButton.addEventListener("click", (e)=>{
            let languageId = document.querySelector("#languageId").value;
            let levelId = document.querySelector("#levelId").value;

            addButton.disabled = true;

            let languagesData = new FormData();

            languagesData.append("languages_id", languageId);
            languagesData.append("language_level_id", levelId);

            addEvent(method, languagesData, (e)=>{
                let newLangId = e.data.data.id.id;
                let newLanguage = Api.get("Languages", languageId);
                let newLevel = Api.get("LanguageLevel", levelId);

                Promise.all([newLanguage, newLevel])
                    .then((e)=>{
                        var template = document.querySelector('#blockTemplate').content.cloneNode(true);
                        template.querySelector("#language-panel-").setAttribute("id", "language-panel-"+newLangId);
                        let button = template.querySelector(".delete-lang");

                        button.setAttribute("data-id", newLangId);
                        button.addEventListener("click", deleteClickEvent);

                        let lang = template.querySelector(".lang_name");
                        lang.setAttribute("data-id", e[0].data.data[0].id);
                        lang.textContent = e[0].data.data[0].name;

                        let level = template.querySelector(".lang_level");
                        level.setAttribute("data-id", e[1].data.data[0].id);
                        level.textContent = e[1].data.data[0].CEFR+` (${e[1].data.data[0].cambridge})`;

                        document.querySelector("#languagesList").appendChild(template);
                        addButton.disabled = false;
                        createToast("Done");
                    })
            })
        })
    }
} catch (e) {}
