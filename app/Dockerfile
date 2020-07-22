#Build Stage Start

#Specify a base image
FROM node:12.4.0-alpine as builder

#Specify a working directory
WORKDIR /app

#Copy the dependencies file
COPY package.json .

#Install dependencies
RUN npm install -qy

#Copy remaining files
COPY . .

#Build the project for production
RUN npm run build 

#Run Stage Start
FROM nginx

#Copy production build files from builder phase to nginx
COPY --from=builder /app/dist /usr/share/nginx/html

EXPOSE 8080

ENTRYPOINT ["nginx","-g","daemon off;"]