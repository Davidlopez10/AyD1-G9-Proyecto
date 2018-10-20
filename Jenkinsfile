pipeline {
  agent any
  stages {
    stage('Build') {
      steps { 
        sh 'cd pensum-toolbox'
	      sh './vendor/bin/codecept run' 
        sh 'cd ..'
      }
    }
  }
}
