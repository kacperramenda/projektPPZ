pipeline {
    agent any

    environment {
        DOCKER_IMAGE_NAME = 'my-laravel-app'
        DOCKER_CONTAINER_APP = 'laravel-app'
        DOCKER_CONTAINER_DB = 'laravel-db'
        GIT_REPO = 'git@github.com:kacperramenda/projektPPZ.git'
        PROD_BRANCH = 'master'
    }

    stages {
        stage('Checkout') {
            steps {
                withCredentials([sshUserPrivateKey(credentialsId: '2727f907-615e-451a-86c8-9bf91e436837', keyFileVariable: 'PK')]) {
                    checkout([
                        $class: 'GitSCM',
                        branches: [[name: "${PROD_BRANCH}"]],
                        userRemoteConfigs: [[
                            url: "${GIT_REPO}"
                        ]]
                    ])
                }
            }
        }

        stage('Composer Install') {
            steps {
                script {
                    sh 'sudo docker run --rm -v $(pwd):/app -w /app composer:2 install'
                }
            }
        }

        stage('Install Frontend Dependencies') {
            steps {
                sh 'sudo docker run --rm -v $(pwd):/app -w /app node:16 npm install'
            }
        }

        stage('Build Frontend') {
            steps {
                sh 'sudo docker run --rm -v $(pwd):/app -w /app node:16 npm run build'
            }
        }

        stage('Build Docker Images') {
            steps {
                script {
                    sh 'sudo docker-compose -f docker/docker-compose.yml build'
                }
            }
        }

        stage('Start Services') {
            steps {
                script {
                    sh 'sudo docker-compose -f docker/docker-compose.yml up -d'
                }
            }
        }

        stage('Wait for Database') {
            steps {
                script {
                    sh '''
                    echo "Czekam na bazę danych..."
                    sleep 10
                    '''
                }
            }
        }

        stage('Run Laravel Migrations') {
            steps {
                script {
                    sh "sudo docker exec ${DOCKER_CONTAINER_APP} php artisan migrate --force"
                }
            }
        }
    }

    post {
        always {
            echo 'Pipeline zakończony.'
        }
        success {
            echo 'Pipeline zakończony sukcesem.'
        }
        failure {
            echo 'Pipeline zakończony niepowodzeniem.'
        }
    }
}
