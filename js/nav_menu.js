document.addEventListener('DOMContentLoaded', function() {
    document.body.setAttribute('style', 'background-color: rgba(0,0,0,.08);');
    let aGeneral = document.querySelectorAll('a');
    aGeneral.forEach(function(element, index) {
	element.setAttribute('style', 'text-decoration:none;color:black;');
    });
    let navMenu = document.createElement('nav');
    navMenu.setAttribute('id', 'menu');
    navMenu.setAttribute('style', 'height:60px;background-color:black;');
    let divPageWidth = document.createElement('div');
    divPageWidth.setAttribute('class', 'page-width');
    let divSitesName = document.createElement('div');
    divSitesName.setAttribute('id', 'sites-name');
    divSitesName.setAttribute('style', 'width:50%;float:left;height:60px;');
    let aSitesName = document.createElement('a');
    aSitesName.setAttribute('href', '/index.php');
    aSitesName.setAttribute('style', 'text-decoration:none;display:block;');
    let h2SitesName = document.createElement('h2');
    h2SitesName.setAttribute('style', 'color:white;line-height:60px;');
    h2SitesName.append("Site's Name");
    aSitesName.append(h2SitesName);
    divSitesName.append(aSitesName);
    let divLinks = document.createElement('div');
    divLinks.setAttribute('id', 'links');
    divLinks.setAttribute('style', 'width:50%;float:right;height:60px;');
    let ulLinks = document.createElement('ul');
    ulLinks.setAttribute('style', 'float:right;list-style:none;');
    let aTitle = ['Advertise', 'Contact', 'About us'];
    for(let i = 0; i < 3; i++) {
	let li = document.createElement('li');
	li.setAttribute('style', 'float:left;padding:10px;line-height:40px;cursor:pointer;');
	let a = document.createElement('a');
	a.setAttribute('class', 'nav-menu');
	a.setAttribute('style', 'color:white;display:block;font-size:14pt;');
	a.append(aTitle[i]);
	li.append(a);
	ulLinks.append(li);
    }
    divLinks.append(ulLinks);
    divPageWidth.append(divSitesName);
    divPageWidth.append(divLinks);
    navMenu.append(divPageWidth);
    document.body.insertBefore(navMenu, document.body.firstElementChild);
    let aNavMenu = document.querySelectorAll('a.nav-menu');
    aNavMenu.forEach(function(element, index) {
	element.addEventListener('mouseover', function(e) {
	    e.target.style['text-decoration'] = 'underline';
	});
	element.addEventListener('mouseout', function(e) {
	    e.target.style['text-decoration'] = 'none';
	});
    });
    let divPage = document.querySelectorAll('div.page-width');
    divPage.forEach(function(element, index) {
	element.setAttribute('style', 'position:relative;width:85%;margin:auto;');
    });
});
