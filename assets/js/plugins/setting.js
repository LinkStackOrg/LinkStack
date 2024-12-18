/*
* Version: 1.2.0
* Template: Hope-Ui - Responsive Bootstrap 5 Admin Dashboard Template
* Author: iqonic.design
* Design and Developed by: iqonic.design
* NOTE: This file contains all the setting change script.
*/

/*----------------------------------------------
Index Of Script
------------------------------------------------

:: Variables

------- Functions --------
:: rtlModeDefault - This function help for change offcanvas position based on rtlMode
:: checkSettingMenu - This function help for on page load setting panel active
:: darkMode - This function help for change dark mode
:: changeMode -This function help for change with create event
:: updateMode - This function help for change dashboard setting on page load based on session storage

------- Listners --------
:: RTL Mode
:: Color Mode
:: Sidebar Color
:: Sidebar Types
:: Sidebar Active Style
:: Navbar & Header style
:: Navbar default style
:: colorChange Mode

------------------------------------------------
Index Of Script
----------------------------------------------*/

(function () {
    "use strict";

    // Variables
    let sidebarTypeSetting = [];

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    //  RTL mode on change offcanvas position change function
    const rtlModeDefault = (check) => {
        if (check) {
            $('.offcanvas-start').addClass('on-rtl start').removeClass('offcanvas-start')
            $('.offcanvas-end').addClass('on-rtl end').removeClass('offcanvas-end')
            $('.on-rtl.start').addClass('offcanvas-end').removeClass('start')
            $('.on-rtl.end').addClass('offcanvas-start').removeClass('end')
        } else {
            $('.offcanvas-start').addClass('on-rtl start').removeClass('offcanvas-start')
            $('.offcanvas-end').addClass('on-rtl end').removeClass('offcanvas-end')
            $('.on-rtl.start').addClass('offcanvas-end').removeClass('start')
            $('.on-rtl.end').addClass('offcanvas-start').removeClass('end')
        }
    }

    // On Page Load Active Function
    const checkSettingMenu = (type, name, value, data) => {
        if(data == 'addedClass'){
            document.querySelectorAll(`[data-setting="${type}"][data-name="${name}"].active`).forEach((el) => {
                el.classList.remove('active')
            });
        }
        if(data == 'noClass'){
            const dataREmove = `[data-setting="${type}"][data-name="${name}"]`;
            const dataAdd = `[data-setting="${type}"][data-name="${name}"][data-value="${value}"]`;
            
            document.querySelectorAll(dataREmove).forEach((el) => {
                el.classList.remove('active')
            });
            document.querySelectorAll(dataAdd).forEach((el) => {
                el.classList.add('active')
            });
        }
    }

    // Dark mode enable & disabled function
    const darkMode = () => {
        if (document.querySelector('body').classList.contains('auto')) {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.querySelector('body').classList.add('dark')
            } else {
                document.querySelector('body').classList.remove('dark')
            }
        }
    }

    // For Dark, RTL & Sidebar Class Update
    const changeMode = (type, value, target) => {
        let detailObj = {}
        // if (type == 'color-mode') {
        //     detailObj = {dark: value}
        //     document.querySelector('body').classList.add(value)
        // }
        if (type == 'dir-mode') {
            detailObj = {dir: value}
            document.querySelector('html').setAttribute('dir',value)
        }
        if (type == 'sidebar') {
            detailObj = {'sidebar-color': value}            
           const sidebarclass= document.querySelector('.sidebar-default')
           if(sidebarclass !== null && sidebarclass !== undefined){
                sidebarclass.classList.add(value)
           }
        }
        const event = new CustomEvent("ChangeMode", {detail: detailObj });
        document.dispatchEvent(event);
    }

    // Page on load function
    const updateMode = () => {
        // Change Mode Custom Event Listners
        document.addEventListener('ChangeMode',(e) => {
            if (e.detail.dir === 'rtl' || e.detail.dir === 'ltr') {
                rtlModeDefault(true)
            }
            if (e.detail.dark !== null || e.detail.dark !== undefined) {
                darkMode()
            }
        })

        // For Dark Mode        
        const colorMode = getCookie('color-mode');
        if (colorMode !== null && colorMode !== undefined) {
            darkMode();
            checkSettingMenu('color-mode', 'color', colorMode, 'noClass');
        }

        // For RTL Mode
        const dirMode =  localStorage.getItem('dir-mode')
        if(dirMode !== null && dirMode !== undefined && dirMode !== 'ltr') {
            checkSettingMenu('dir-mode', 'dir', dirMode, 'addedClass')
            changeMode('dir-mode', dirMode)
        }

        // For Sidebar Color
        const sidebarColors =  localStorage.getItem('sidebar')
        if(sidebarColors !== null && sidebarColors !== undefined) {
            checkSettingMenu('sidebar', 'sidebar-color', sidebarColors, 'addedClass')
            changeMode('sidebar', sidebarColors)
        }

        // For Sidebar Types
        const sidebarTypeSession = localStorage.getItem('sidebarType')
        if(sidebarTypeSession !== null && sidebarTypeSession !== undefined) {
            sidebarTypeSetting = JSON.parse(sidebarTypeSession)
            Array.from(sidebarTypeSetting,(type) => {
                document.querySelectorAll(`[data-setting="sidebar"][data-name="sidebar-type"][data-value="${type}"]`).forEach((el) => {
                    el.classList.add('active')
                });
                changeMode('sidebar', type)
            })
        }

        // For Sidebar Active Style
        const allActiveType =  localStorage.getItem('sidebar-style')
        if(allActiveType !== null && allActiveType !== undefined) {
            document.querySelector('.sidebar').classList.remove('navs-rounded-all')
            document.querySelector('.sidebar').classList.add(`${allActiveType}`)
            checkSettingMenu('sidebar', 'sidebar-item', allActiveType, 'addedClass')
            changeMode('sidebar-style', allActiveType)
        }

        // For Navbar & Header Style
        const allNavbarType = localStorage.getItem('navbarTypes')
        if(allNavbarType !== null && allNavbarType !== undefined){
            if(allNavbarType == 'nav-glass' || allNavbarType == 'navs-sticky' || allNavbarType == 'navs-transparent'){
                document.querySelector('.iq-navbar').classList.add(`${allNavbarType}`)
            }
            if(allNavbarType == 'navs-bg-color'){
                document.querySelector('.iq-navbar').classList.remove('nav-glass','navs-sticky','navs-transparent')
                document.querySelector('.iq-navbar-header').classList.add(`${allNavbarType}`)
            }
            checkSettingMenu('navbar', 'navbar-type', allNavbarType, 'noClass')
        }
    }

    updateMode()

    //dark-mode & light-mode
    const colorMode = document.querySelectorAll('[data-setting="color-mode"][data-name="color"]')
    Array.from(colorMode, (mode) => {
        mode.addEventListener('click', (e) => {
            Array.from(colorMode, (el) => {
                el.classList.remove('active')
                document.querySelector('body').classList.remove(el.getAttribute('data-value'))
            })
            document.cookie = `color-mode=${mode.getAttribute('data-value')}; path=/;`;
            mode.classList.add('active')
            document.querySelector('body').classList.add(mode.getAttribute('data-value'))
            changeMode('color-mode', mode.getAttribute('data-value'))
        })
    })

    //rtl & ltr
    const dirMode = document.querySelectorAll('[data-setting="dir-mode"][data-name="dir"]')
    Array.from(dirMode, (mode) => {
        mode.addEventListener('click', (e) => {
            Array.from(dirMode, (el) => {
                el.classList.remove('active')
            })
            if (!mode.classList.contains('active')) {
                Array.from(document.querySelectorAll(`[data-value="${mode.getAttribute('data-value')}"]`), (el) => el.classList.add('active'))
                localStorage.setItem('dir-mode', mode.getAttribute('data-value'))
                changeMode('dir-mode', mode.getAttribute('data-value'))
            }
        })
    })
    
    //Sidebar Color
    const sidebarColors = document.querySelectorAll('[data-setting="sidebar"][data-name="sidebar-color"]')
    Array.from(sidebarColors, (mode) => {
        mode.addEventListener('click', (e) => {
            Array.from(sidebarColors, (el) => {
                el.classList.remove('active')
                document.querySelector('.sidebar-default').classList.remove(el.getAttribute('data-value'))
            })
            localStorage.setItem('sidebar', mode.getAttribute('data-value'))
            mode.classList.add('active')
            document.querySelector('.sidebar-default').classList.add(mode.getAttribute('data-value'))
            changeMode('sidebar', mode.getAttribute('data-value'))
        })
    })

    // Sidebar type style
    const sidebarTypes = document.querySelectorAll('[data-setting="sidebar"][data-name="sidebar-type"]')
    Array.from(sidebarTypes, (sidebarType) => {
        sidebarType.addEventListener('click', (e) => {
            if (sidebarType.classList.contains('active')) {
                sidebarType.classList.remove('active')
                document.querySelector('.sidebar-default').classList.remove(sidebarType.getAttribute('data-value'))
                const sidebarTypeIndexOf = sidebarTypeSetting.findIndex(type => type === sidebarType.getAttribute('data-value'))
                sidebarTypeSetting.splice(sidebarTypeIndexOf, 1)
                if (sidebarType.getAttribute('data-extra-value') !== null) {
                    document.querySelector('.sidebar-default').classList.remove(sidebarType.getAttribute('data-extra-value'))
                    document.querySelector(`[data-value="${sidebarType.getAttribute('data-extra-value')}"]`).classList.remove('active')

                    const sidebarExtraTypeIndexOf = sidebarTypeSetting.findIndex(type => type === sidebarType.getAttribute('data-extra-value'))
                    sidebarTypeSetting.splice(sidebarExtraTypeIndexOf, 1)
                }
            } else {
                Array.from(document.querySelectorAll(`[data-value="${sidebarType.getAttribute('data-value')}"]`), (el) => el.classList.add('active'))
                document.querySelector('.sidebar-default').classList.add(sidebarType.getAttribute('data-value'))
                if (sidebarTypeSetting.indexOf(sidebarType.getAttribute('data-value')) === -1) {
                    sidebarTypeSetting.push(sidebarType.getAttribute('data-value'))
                }
                if (sidebarType.getAttribute('data-extra-value') !== null) {
                    document.querySelector('.sidebar-default').classList.add(sidebarType.getAttribute('data-extra-value'))
                    Array.from(document.querySelectorAll(`[data-value="${sidebarType.getAttribute('data-extra-value')}"]`), (el) => el.classList.add('active'))
                    if(sidebarTypeSetting.indexOf(sidebarType.getAttribute('data-extra-value')) === -1) {
                        sidebarTypeSetting.push(sidebarType.getAttribute('data-extra-value'))
                    }
                }
            }
            localStorage.setItem('sidebarType', JSON.stringify(sidebarTypeSetting))
        })
    })

    //Sidebar Active Style 
    const allActiveType = document.querySelectorAll('[data-setting="sidebar"][data-name="sidebar-item"]')
    Array.from(allActiveType, (activeStyle) => {
        activeStyle.addEventListener('click', (e) => {
            if(!activeStyle.classList.contains('active')){
                Array.from(allActiveType, (el) => {
                    el.classList.remove('active')
                    document.querySelector('.sidebar-default').classList.remove(el.getAttribute('data-value'))
                })
                localStorage.setItem('sidebar-style', activeStyle.getAttribute('data-value'))
                activeStyle.classList.add('active')
                Array.from(document.querySelectorAll(`[data-value="${activeStyle.getAttribute('data-value')}"]`), (el) => el.classList.add('active'))
                changeMode('sidebar', activeStyle.getAttribute('data-value'))
            }
        })
    })

    // Navbar Style
    const allNavbarType = document.querySelectorAll('[data-setting="navbar"][data-name="navbar-type"]')
    Array.from(allNavbarType, (navbarType) => {
        navbarType.addEventListener('click', (e) => {
            Array.from(allNavbarType, (el) => {
                el.classList.remove('active')
                document.querySelector(el.getAttribute('data-target')).classList.remove(el.getAttribute('data-value'))
            })
            localStorage.setItem('navbarTypes', navbarType.getAttribute('data-value'))
            Array.from(document.querySelectorAll(`[data-value="${navbarType.getAttribute('data-value')}"]`), (el) => el.classList.add('active'))
            document.querySelector(navbarType.getAttribute('data-target')).classList.add(navbarType.getAttribute('data-value'))
            changeMode('navbarTypes', navbarType.getAttribute('data-value'), navbarType.getAttribute('data-target'))
        })
    })

    // Navbar default style
    const defaultNavbarType = document.querySelector('[data-setting="navbar"][data-name="navbar-default"]')
    if (defaultNavbarType !== null) {
        defaultNavbarType.addEventListener("click", (e) => {
            document.querySelector('.iq-navbar').classList.remove('nav-glass','navs-sticky', 'navs-transparent')
            document.querySelector('.iq-navbar-header').classList.remove('navs-bg-color')
            localStorage.setItem('navbarTypes', '')
        })
    }
   
    // For colorChange Mode
    const customizerMode = (custombodyclass,colors,colorInfo) => {
    document.querySelector('body').classList.add(`${custombodyclass}`)
    localStorage.setItem('colorcustomchart-mode', getComputedStyle(document.body).getPropertyValue('--bs-primary'))
    document.documentElement.style.setProperty('--bs-info', colors);
    const color = localStorage.getItem('colorcustomchart-mode')
    if(color !== 'null' && color !== undefined && color !== ''){
    const event = new CustomEvent("ColorChange", {detail :{detail1:color.trim(), detail2:colors.trim()}});
    document.dispatchEvent(event);
    }
    else{
    const event = new CustomEvent("ColorChange", {detail :{detail1:colorInfo.trim(), detail2:colors.trim()}});
    document.dispatchEvent(event);
    }
    // const elements = document.querySelectorAll('[data-setting="color-mode1"][data-name="color"]')
    // Array.from(elements, (mode) => {
    //     const colorclass = mode.getAttribute('data-value');
    //     if(colorclass === custombodyclass ){
    //         mode.classList.add('active')
    //     }
    //     else{
    //         mode.classList.remove('active')
    //     }
    // })
    }

    const elements = document.querySelectorAll('[data-setting="color-mode1"][data-name="color"]')
    Array.from(elements, (mode) => {
    mode.addEventListener('click', (e) => {
        Array.from(elements, (el) => {
            el.classList.remove('active')
            document.querySelector('body').classList.remove(el.getAttribute('data-value'))
        })
        localStorage.setItem('colorcustom-mode', mode.getAttribute('data-value'))
        localStorage.setItem('colorcustominfo-mode', mode.getAttribute('data-info'))
        
        mode.classList.add('active')
        const colors = mode.getAttribute('data-info');
        const color = getComputedStyle(document.body).getPropertyValue('--bs-primary');
        customizerMode(mode.getAttribute('data-value'),colors,color)
        
        })
    })
    
    const custombodyclass = localStorage.getItem('colorcustom-mode')
    const colors = localStorage.getItem('colorcustominfo-mode')
    const color = localStorage.getItem('colorcustomchart-mode')
    if(custombodyclass !== null && custombodyclass !== undefined && colors !== null && colors !== undefined){
        customizerMode(custombodyclass,colors,color)     
    }

})()
