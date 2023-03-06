const articleList = []; // In a real app this list would be full of articles.

// renaming variable to avoid name conflict
const MAX_KUDOS = 5;

// reduce function to get each element of the array
// without use of a temporary variable to store the sums of kudos
function calculateTotalKudos(articles) {

  // the reduce function sums all the values ​​of kudos in the articles array accumulating them into totalKudos, then returns totalKudos.
  return articles.reduce((totalKudos, article) => totalKudos + article.kudos, 0); 

}

/*
// old function 
function calculateTotalKudos(articles) {
  var kudos = 0;
  
  for (let article of articles) {
    kudos += article.kudos;
  }
  
  return kudos;
}
*/

document.write(`
  <p>Maximum kudos you can give to an article: ${MAX_KUDOS}</p>
  <p>Total Kudos already given across all articles: ${calculateTotalKudos(articleList)}</p>
`);


